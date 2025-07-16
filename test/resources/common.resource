*** Settings ***
Library    SeleniumLibrary
Resource    ../variables/urls.resource

*** Keywords ***
Open Edulien
    Open Browser    ${url}   ${Browser}
    Maximize Browser Window

Close Session
    Close Browser