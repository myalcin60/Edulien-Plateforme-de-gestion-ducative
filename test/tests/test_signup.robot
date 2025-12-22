*** Settings ***
Library  SeleniumLibrary
Resource    ../keywords/auth_keywords.resource
Resource    ../resources/common.resource


    
*** Comments ***
1 user goes to signup page
2 user enters fileds valid
3 user confirms that the signup was successful

*** Test Cases ***
Sign Up as teacher
    [Tags]    smoke  pozitif
    Open Edulien
    Click Link    SignUp
    SignUp As Teacher
    Close Session