import time
import pytesseract
from PIL import Image
from datetime import timedelta

def parseOCR(file_path):
    imageDataDict = {}
    try:
        imgData = Image.open(file_path)
        imageText = pytesseract.image_to_string(imgData)
        imageDataDict['success'], imageDataDict['data'] = True, imageText
    except Exception:
        imageDataDict['success'] = False
        imageDataDict['message'] = 'File not found, please try again!'
    return imageDataDict
    
if __name__ == "__main__":
    startTime = time.time()
    filePath = input("Enter file path: ")
    jsonData = parseOCR(filePath)
    print(jsonData)
    print(f'\nJob completed successfully, time elapsed: {timedelta(seconds = int(time.time() - startTime))} HH:MM:SS\n')