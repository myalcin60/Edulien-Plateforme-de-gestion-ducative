*** Settings ***
Library  SeleniumLibrary
Resource     ../keywords/auth_keywords.resource
Resource     ../resources/common.resource





*** Comments ***
1. User go to Edulien home page
2. User clicks login button
3. User enters valide email and password
4. User clicks submit button
5. User confirms that the login was succesful

# robot --include Smoke --outputdir Results Test

*** Keywords ***
 
clicks login button 
    Click Link  ${login}   
enters valide email and password
    Input Text   ${email_lct}   teacher@gmail.com
    Input Password    ${password_lct}   1234
clicks submit button
    Click Button  ${submit_btn}
confirms that the login was succesful
   Element Should Be Visible  ${profile_text}

*** Test Cases ***
Login As Teacher   [Tags]  smoke pozitif
    Open Edulien
    Login As Teacher with valid fields
    Close Browser
    [Teardown]   
    
Login as Student   [Tags]  smoke pozitif
    Open Edulien
    Login As Student with valid fields
    Close Browser
    [Teardown]

Login As Teacher   [Tags]  smoke  negatif
    Open Edulien
    Login As Teacher with invalid email
    Close Browser
    [Teardown]   