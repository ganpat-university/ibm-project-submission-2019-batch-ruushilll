import time
import pdfplumber
from datetime import timedelta

def parseRaw(file_path):
    resumeDataDict = {}
    try:
        with pdfplumber.open(file_path) as pdf:
            resumeDataDict['success'] = True
            resumeDataDict['pages'] = len(pdf.pages)

            pdfData = ''
            for pageData in range(resumeDataDict['pages']):
                tempPageNum = pdf.pages[pageData]
                pageText = tempPageNum.extract_text()
                pdfData += pageText

            resumeDataDict['data'] = pdfData
    except FileNotFoundError:
        resumeDataDict['success'] = False
        resumeDataDict['message'] = 'File not found, please try again!'
    return resumeDataDict
        

def parseResume(file_path):
    resumeDataDict = {}
    try:
        with pdfplumber.open(file_path) as pdf:
            resumeDataDict['success'] = True
            resumeDataDict['pages'] = len(pdf.pages)
            for pageData in range(resumeDataDict['pages']):
                lineData = []
                tempPageNum = pdf.pages[pageData]
                pageText = tempPageNum.extract_text()
                pageLines = pageText.split('\n')

                for indexVal, tempLine in enumerate(pageLines):
                    if pageData == 0:
                        resumeDataDict['name'] = pageLines[0]
                    if 'email' in tempLine.lower():
                        resumeDataDict['email'] = tempLine.split(': ')[-1]
                    if 'phone' in tempLine.lower():
                        resumeDataDict['phone'] = tempLine.split(': ')[-1]
                    if 'portfolio' in tempLine.lower():
                        resumeDataDict['portfolio'] = tempLine.split(': ')[-1]
                    if 'github' in tempLine.lower():
                        resumeDataDict['github'] = tempLine.split(': ')[1].split(' ')[0]
                    if 'medium' in tempLine.lower():
                        resumeDataDict['medium'] = tempLine.split(': ')[1].split(' ')[0]
                    if 'linkedin' in tempLine.lower():
                        resumeDataDict['linkedin'] = tempLine.split(': ')[-1]
                    if 'education' in tempLine.lower():
                        lineData.append([pageData, indexVal])
                    if 'skills and certifications' in tempLine.lower():
                        lineData.append([pageData, indexVal])
                    if 'professional experience' in tempLine.lower():
                        lineData.append([pageData, indexVal])
                    if 'volunteer experience' in tempLine.lower():
                        lineData.append([pageData, indexVal])
                    if 'projects' in tempLine.lower():
                        lineData.append([pageData, indexVal])
                    if 'achievements' in tempLine.lower():
                        lineData.append([pageData, indexVal])

                lineData.append([pageData, len(pageLines)])
                for i in range(len(lineData)-1):
                    mainData, finalString = '', ''
                    for j in range(lineData[i][1], lineData[i+1][1]):
                        if j == lineData[i][1]:
                            mainData = pageLines[j].lower()
                        else:
                            finalString += pageLines[j]
                    resumeDataDict[mainData] = finalString
    except FileNotFoundError:
        resumeDataDict['success'] = False
        resumeDataDict['message'] = 'File not found, please try again!'
    return resumeDataDict

if __name__ == "__main__":
    startTime = time.time()
    filePath = input("Enter file path: ")
    jsonData = parseResume(filePath)
    print(jsonData)
    print(f'\nJob completed successfully, time elapsed: {timedelta(seconds = int(time.time() - startTime))} HH:MM:SS\n')