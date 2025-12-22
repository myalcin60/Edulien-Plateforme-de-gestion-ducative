*** Settings ***
Library     SeleniumLibrary
Resource    ../locators/login_locators.resource
Resource    ../locators/singup_locators.resource
Resource    ../variables/users.resource
Library    FakerLibrary

*** Variables ***
${Login text}      xpath =//h2[text()='Login']
*** Keywords ***

SignUp As Teacher
 
    ${t_first_name}    FakerLibrary.First Name
    ${t_last_name}     FakerLibrary.Last Name
    ${t_email}         FakerLibrary.Email
    ${t_password}      FakerLibrary.Password    length=10    special_chars=True    digits=True
    Input Text   ${lct_fistName}     ${t_first_name}
    Input Text   ${lct_lastName}     ${t_last_name}
    Input Text   ${lct_email}        ${t_email} 
    Input Text   ${lct_password}    ${t_password}
    Select From List By Value  ${selct_role}   teacher
    Scroll Element Into View  ${btn_register}
    Click Button   ${btn_register}
    Wait Until Element Is Visible  ${Login text}
   
    

Login As Teacher with valid fields
    Wait Until Element Is Enabled  ${login}
    Click Link  ${login}  
    Input Text  ${email_lct}  teacher@gmail.com
    Input Password  ${password_lct}  1234
    Click Button   ${submit_btn}
    Wait Until Element Is Visible  ${profile_text}
    Element Should Be Visible  ${profile_text}


Login As Teacher with invalid email
    Wait Until Element Is Enabled  ${login}
    Click Link  ${login}  
    Input Text  ${email_lct}  wrong@gmail.com
    Input Password  ${password_lct}  1234
    Click Button   ${submit_btn}
    Element Should Not Be Visible  ${profile_text}

Login As Student with valid fields
    Wait Until Element Is Enabled  ${login}
    Click Link  ${login}  
    Input Text   ${email_lct}   ${s_email}
    Input Password   ${password_lct}  ${s_password}
    Click Button   ${submit_btn}
    Wait Until Element Is Visible  ${profile_text}
    Element Should Be Visible  ${profile_text}