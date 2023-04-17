from django.urls import path
from . import views

urlpatterns = [
    path('getBillDetails', views.getBillDetails),
    path('parseResumeData', views.parseResumeData),
    path('parseRawData', views.parseRawData),
    path('parseOCRData', views.parseOCRData)
]