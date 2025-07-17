*** Settings ***
Library  SeleniumLibrary
Resource    ../keywords/auth_keywords.resource
Resource    ../resources/common.resource


    
*** Comments ***
1 user goes to signup page
2 user enters fileds valid
3 user confirms that the signup was successful

*** Test Cases ***
signup  [Tags]  smoke
    Open Edulien
    SignUp As Teacher
    Close Session