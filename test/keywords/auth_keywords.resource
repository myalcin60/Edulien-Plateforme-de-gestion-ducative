*** Settings ***
Library     SeleniumLibrary
Resource    ../locators/login_locators.resource
Resource    ../locators/singup_locators.resource
Resource    ../variables/users.resource

*** Keywords ***

SignUp As Teacher
    Click Link   SignUp  
    Input Text   ${lct_fistName}     ${t_first_name}
    Input Text   ${lct_lastName}     ${t_last_name}
    Input Text   ${lct_email}        ${t_email} 
    Input Text   ${lct_password}    ${t_password}
    Select From List By Value  ${selct_role}   ${t_role}
    Scroll Element Into View  ${btn_register}
    Scroll Element Into View  ${btn_register}
    

Login As Teacher with valid fields
    Wait Until Element Is Enabled  ${login}
    Click Link  ${login}  
    Input Text  ${email_lct}  teacher@yopmail.com
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