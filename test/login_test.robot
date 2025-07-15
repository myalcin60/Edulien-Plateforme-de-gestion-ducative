*** Settings ***
Library  SeleniumLibrary
Resource  ./resources/AuthKeywords.resource

*** Variables ***


${login}      xpath=//*[@id="navbarSupportedContent"]/div[2]/div/a[1]
${email}      student@gmail.com
${email_lct}   id=email
${password}   1234
${password_lct}  id=password
${submit_btn}   xpath = //button[@type='submit']
${profile_text}  xpath = /html/body/main/div[2]/form/h2



*** Comments ***
1. User go to Edulien home page
2. User clicks login button
3. User enters valide email and password
4. User clicks submit button
5. User confirms that the login was succesful


*** Keywords ***
 
clicks login button 
    Click Link  ${login}   
enters valide email and password
    Input Text   ${email_lct}   ${email}
    Input Password    ${password_lct}   ${password}
clicks submit button
    Click Button  ${submit_btn}
confirms that the login was succesful
   Element Should Be Visible  ${profile_text}

*** Test Cases ***
Login  [Tags]  smoke
    go to Edulien home page
    clicks login button
    enters valide email and password
    clicks submit button
    confirms that the login was succesful
    Close Browser
    [Teardown]   
  