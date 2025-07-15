*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${url}        http://localhost/edu_php/views/pages/main.php
${Browser}    chrome
${first_name}     teacher
${last_name}        TEST
${email}        text@gmail.com
${password}     1234
${role}        teacher
${selct_role}      xpath= //select[@class="form-select"]  
${register_btn}   xpath = /html/body/main/div/div[2]/form/button
${titre}        /html/body/main/h2

*** Keywords ***
go to Edulien home page
  Open Browser  ${url}  ${Browser}      
  Maximize Browser Window 
user enters fileds valid
    Input Text  id=firstname    ${first_name}
    Input Text  id=lastname    ${last_name}
    Input Text  id=email    ${email} 
    Input Text  id=password    ${password}
    Select From List By Value  ${selct_role}  ${role}
    Scroll Element Into View  ${register_btn}
   
    Click Button  ${register_btn}    
    


Close Browser Session
    Close Browser