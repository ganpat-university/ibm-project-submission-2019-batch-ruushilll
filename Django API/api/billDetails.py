import time
import traceback
from selenium import webdriver
from datetime import timedelta
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager

def getXPATHDetails(webDriver, xPathExpression):
    return webDriver.find_elements(by = By.XPATH, value = xPathExpression)[0].text

def fetchRequiredData(clientID):
    driverOptions = webdriver.ChromeOptions()
    driverOptions.add_argument("--headless")
    webDriver = webdriver.Chrome(service=Service(ChromeDriverManager().install()), options=driverOptions)
    webDriver.get(f'https://ugvcl.info/UGBILL/BillHTML.php?cno={clientID}')

    try:
        userDetails = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[1]/td[1]').split('\n')[0]
        subDivOffice = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[1]/td[3]/strong')
        routeCode = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[2]/td[2]/strong')
        billNum = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[3]/td[2]/strong')
        billDate = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[4]/td[2]/strong')
        lastPaymentDate = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[5]/td[2]/strong')

        federerCD = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[7]/td[1]/b[1]')
        refererCD = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[7]/td[1]/b[2]')

        tarrifValue = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[7]/td[2]/table/tbody/tr/td[1]/strong')
        meterCode = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[7]/td[2]/table/tbody/tr/td[2]/strong')
        hpkwValue = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[7]/td[2]/table/tbody/tr/td[3]/strong')
        seasonalValue = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[7]/td[2]/table/tbody/tr/td[4]/strong')
        daysValue = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[7]/td[2]/table/tbody/tr/td[5]/strong')
        sdValue = getXPATHDetails(webDriver, '/html/body/table[2]/tbody/tr[7]/td[2]/table/tbody/tr/td[6]/strong')

        consumerNumber = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[2]/td[1]/strong')
        meterNumber = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[2]/td[2]/strong')

        phaseValue = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[4]/td[1]/strong')
        meterStatus = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[4]/td[2]/strong')

        presentActiveReading = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[6]/td[2]/table/tbody/tr/td[1]/b')
        presentIMPReading = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[6]/td[2]/table/tbody/tr/td[2]/b')
        presentRNReading = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[6]/td[2]/table/tbody/tr/td[3]/b')
        presentEXPReading = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[6]/td[2]/table/tbody/tr/td[4]/b')

        pastActiveReading = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[7]/td[2]/table/tbody/tr/td[1]')
        pastIMPReading = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[7]/td[2]/table/tbody/tr/td[2]/strong')
        pastRNReading = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[7]/td[2]/table/tbody/tr/td[3]/strong')
        pastEXPReading = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[7]/td[2]/table/tbody/tr/td[4]/strong')

        readingActiveDiff = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[8]/td[2]/table/tbody/tr/td[1]/strong')
        readingIMPDiff = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[8]/td[2]/table/tbody/tr/td[2]/strong')
        readingRNDiff = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[8]/td[2]/table/tbody/tr/td[3]/strong')
        readingEXPDiff = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[8]/td[2]/table/tbody/tr/td[4]/strong')

        mfValue = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[9]/td[2]/strong')
        totalConsumption = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[10]/td[2]/strong')
        averageConsumption = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[11]/td[2]/strong')
        maxDemand = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[12]/td[2]/strong')
        avgMaxDemand = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[13]/td[2]/strong')
        totalCompanyCharges = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[14]/td[2]/strong')
        provisionalBillAmt = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[15]/td[2]/strong')
        adjustmentAmt = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[16]/td[2]/strong')

        lastThreeMonthsUnitM1Name = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[18]/td[2]/table/tbody/tr/td[1]')
        lastThreeMonthsUnitM1Unit = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[19]/td[2]/table/tbody/tr/td[1]/strong')
        lastThreeMonthsUnitM1BillAmt = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[20]/td[2]/table/tbody/tr/td[1]/strong')
        lastThreeMonthsUnitM2Name = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[18]/td[2]/table/tbody/tr/td[2]')
        lastThreeMonthsUnitM2Unit = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[19]/td[2]/table/tbody/tr/td[2]/strong')
        lastThreeMonthsUnitM2BillAmt = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[20]/td[2]/table/tbody/tr/td[2]/strong')
        lastThreeMonthsUnitM3Name = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[18]/td[2]/table/tbody/tr/td[3]')
        lastThreeMonthsUnitM3Unit = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[19]/td[2]/table/tbody/tr/td[3]/strong')
        lastThreeMonthsUnitM3BillAmt = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[20]/td[2]/table/tbody/tr/td[3]/strong')

        fixedCharges = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[2]/td[5]/strong')
        energyCharges = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[3]/td[6]/strong')
        minimumCharges = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[4]/td[6]/strong')
        reactiveCharges = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[5]/td[5]/strong')
        fuelCharges = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[6]/td[5]/strong')
        edCharges = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[7]/td[5]/strong')
        meterCharges = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[8]/td[5]/strong')
        delayedPaymentCharges = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[9]/td[6]/strong')
        billAmtValue = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[10]/td[6]/strong')
        provisionalBillAmtValue = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[11]/td[6]/strong')
        netTotalBillAmtValue = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[12]/td[6]/strong')
        arrearsOnDate = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[13]/td[6]/strong')
        solarPur = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[14]/td[6]/strong')
        unprocessPaymentAmt = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[15]/td[6]/strong')
        grandTotalAmt = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[16]/td[6]/strong')
        govtRelief = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[17]/td[4]/strong')
        interestAmt = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[19]/td[5]/strong')
        theftArrears = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[20]/td[5]/strong')
        litigationArrears = getXPATHDetails(webDriver, '/html/body/table[3]/tbody/tr[21]/td[4]/strong')

        jsonDataDict = {
            'success': True,
            'userDetails': userDetails,
            'subDivisionOffice': subDivOffice,
            'routeCode': routeCode,
            'billNumber': billNum,
            'billDate': billDate,
            'lastPaymentDate': lastPaymentDate,
            'federerCD': federerCD,
            'refererCD': refererCD,
            'tarrif': tarrifValue,
            'meterCode': meterCode,
            'hpkwValue': hpkwValue,
            'seasonalValue': seasonalValue,
            'daysValue': daysValue,
            'SD': sdValue,
            'consumerNumber': consumerNumber,
            'meterNumber': meterNumber,
            'phase': phaseValue,
            'meter': meterStatus,
            'present': {
                'presentActiveReading': presentActiveReading,
                'presentIMPReading': presentIMPReading,
                'presentRNReading': presentRNReading,
                'presentEXPReading': presentEXPReading
            },
            'past': {
                'pastActiveReading': pastActiveReading,
                'pastIMPReading': pastIMPReading,
                'pastRNReading': pastRNReading,
                'pastEXPReading': pastEXPReading
            },
            'reading': {
                'readingActiveDiff': readingActiveDiff,
                'readingIMPDiff': readingIMPDiff,
                'readingRNDiff': readingRNDiff,
                'readingEXPDiff': readingEXPDiff
            },
            'data': {
                'mf': mfValue,
                'totalConsumption': totalConsumption,
                'averageConsumption': averageConsumption,
                'maxDemand': maxDemand,
                'avgMaxDemand': avgMaxDemand,
                'totalCompanyCharges': totalCompanyCharges,
                'provisionalBillAmt': provisionalBillAmt,
                'adjustmentAmt': adjustmentAmt
            },
            'pastQuarter': {
                'lastThreeMonthsUnitM1Name': lastThreeMonthsUnitM1Name,
                'lastThreeMonthsUnitM1Unit': lastThreeMonthsUnitM1Unit,
                'lastThreeMonthsUnitM1BillAmt': lastThreeMonthsUnitM1BillAmt,
                'lastThreeMonthsUnitM2Name': lastThreeMonthsUnitM2Name,
                'lastThreeMonthsUnitM2Unit': lastThreeMonthsUnitM2Unit,
                'lastThreeMonthsUnitM2BillAmt': lastThreeMonthsUnitM2BillAmt,
                'lastThreeMonthsUnitM3Name': lastThreeMonthsUnitM3Name,
                'lastThreeMonthsUnitM3Unit': lastThreeMonthsUnitM3Unit,
                'lastThreeMonthsUnitM3BillAmt': lastThreeMonthsUnitM3BillAmt
            },
            'miscellaneous': {
                'fixedCharges': fixedCharges,
                'energyCharges': energyCharges,
                'minimumCharges': minimumCharges,
                'reactiveCharges': reactiveCharges,
                'fuelCharges': fuelCharges,
                'edCharges': edCharges,
                'meterCharges': meterCharges,
                'delayedPaymentCharges': delayedPaymentCharges,
                'billAmtValue': billAmtValue,
                'provisionalBillAmtValue': provisionalBillAmtValue,
                'netTotalBillAmtValue': netTotalBillAmtValue,
                'arrearsOnDate': arrearsOnDate,
                'solarPur': solarPur,
                'unprocessPaymentAmt': unprocessPaymentAmt,
                'grandTotalAmt': grandTotalAmt,
                'govtRelief': govtRelief,
                'interestAmt': interestAmt,
                'theftArrears': theftArrears,
                'litigationArrear': litigationArrears
            }
        }
        webDriver.quit()
        return jsonDataDict
    except Exception:
        return {'success': False, 'message': traceback.format_exc()}

if __name__ == "__main__":
    startTime = time.time()
    clientID = input("Enter your client ID: ")
    jsonData = fetchRequiredData(clientID)
    print(jsonData)
    print(f'\nJob completed successfully, time elapsed: {timedelta(seconds = int(time.time() - startTime))} HH:MM:SS\n')
