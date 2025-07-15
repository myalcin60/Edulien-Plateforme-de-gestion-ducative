*** Settings ***
Library  SeleniumLibrary
Resource  ./resources/AuthKeywords.resource


    
*** Comments ***
1 user goes to signup page
2 user enters fileds valid
3 user confirms that the signup was successful

*** Test Cases ***
signup  [Tags]  smoke
    go to Edulien home page
    user enters fileds valid
   
    Close Browser Session