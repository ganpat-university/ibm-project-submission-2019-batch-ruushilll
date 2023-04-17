import uploadData
from parseImage import parseOCR
from rest_framework import status
from billDetails import fetchRequiredData
from readPDF import parseResume, parseRaw
from rest_framework.response import Response
from rest_framework.decorators import api_view

def getXPATHDetails(webDriver, xPathExpression):
    return webDriver.find_elements(by = By.XPATH, value = xPathExpression)[0].text

@api_view(['GET'])
def getBillDetails(request):
    authToken = request.headers.get('Authorization')
    if authToken == None:
        return Response({'success': False, 'error': 'Forbidden'}, status=status.HTTP_403_FORBIDDEN)
    else:
        if authToken.split(' ')[1] == '':   # Django API Authentication Token Validation
            clientID = request.query_params.get('clientID')
            if clientID == None:
                return Response({'success': False, 'error': 'Missing endpoint parameters'}, status=status.HTTP_400_BAD_REQUEST)
            else:
                jsonDataDict = fetchRequiredData(clientID)
                if jsonDataDict['success']:
                    s3UploadStatus = uploadData.uploadFile(jsonDataDict, 'Get Bill Details')
                    jsonDataDict['S3'], jsonDataDict['S3FileName'] = s3UploadStatus['Status'], s3UploadStatus['fileName']
                return Response(jsonDataDict)
        else:
            return Response({'success': False, 'error': 'Forbidden'}, status=status.HTTP_403_FORBIDDEN)

@api_view(['GET'])
def parseResumeData(request):
    resumeFilePath = request.query_params.get('filePath')
    if resumeFilePath == None:
        return Response({'success': False, 'error': 'Missing endpoint parameters'}, status=status.HTTP_400_BAD_REQUEST)
    else:
        jsonDataDict = parseResume(resumeFilePath)
        if jsonDataDict['success']:
            s3UploadStatus = uploadData.uploadFile(jsonDataDict, 'Parse Resume Data')
            jsonDataDict['S3'], jsonDataDict['S3FileName'] = s3UploadStatus['Status'], s3UploadStatus['fileName']
        return Response(jsonDataDict)
    
@api_view(['GET'])
def parseRawData(request):
    resumeFilePath = request.query_params.get('filePath')
    if resumeFilePath == None:
        return Response({'success': False, 'error': 'Missing endpoint parameters'}, status=status.HTTP_400_BAD_REQUEST)
    else:
        jsonDataDict = parseRaw(resumeFilePath)
        if jsonDataDict['success']:
            s3UploadStatus = uploadData.uploadFile(jsonDataDict, 'Parse Raw Data')
            jsonDataDict['S3'], jsonDataDict['S3FileName'] = s3UploadStatus['Status'], s3UploadStatus['fileName']
        return Response(jsonDataDict)

@api_view(['GET'])
def parseOCRData(request):
    imageFilePath = request.query_params.get('filePath')
    if imageFilePath == None:
        return Response({'success': False, 'error': 'Missing endpoint parameters'}, status=status.HTTP_400_BAD_REQUEST)
    else:
        jsonDataDict = parseOCR(imageFilePath)
        if jsonDataDict['success']:
            s3UploadStatus = uploadData.uploadFile(jsonDataDict, 'Parse OCR Data')
            jsonDataDict['S3'], jsonDataDict['S3FileName'] = s3UploadStatus['Status'], s3UploadStatus['fileName']
        return Response(jsonDataDict)