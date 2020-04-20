# Starred Repos


[![Build Status](https://travis-ci.org/chiefbrob/interview_foundation.svg?branch=master)](https://travis-ci.org/chiefbrob/interview_foundation)

A laravel 7 project to list your starred repos on Github.


Live site: [Starred Repos on Chiefbrob](http://starredrepos.on.chiefbrob.info)


## The business story

Stories written in Gherkin

```
Feature: Github API Integration
  As a user of the site
  I want to add my github token to a form
  So I can then see my starred repos

Scenario: User can log in
  Given I view the home page
  Then I should see a login button
  And when I click that then I should be logged in
  And redirected back to the home page

###
# This form will be vuejs
# this form will live in the home page when authenticated
# this form will use axios
# The form will use https://bootstrap-vue.js.org/
###
Scenario: Form on Home page to add my Github token
  Given I am logged in
  Then I can add my github token to a form
  And click save
  Then it will be encrypted in the database in the user table
  ****Then**** the home page will show that token decrypted
  And if the token is null it will say "No Token? Click here to learn how to make token"
  And it will link in a new tab to github docs so user knows how to make a token

###
# This button will be vuejs
# it will be a separate component from above
# The button and list will use https://bootstrap-vue.js.org/
# Using this library to help with the work
# https://github.com/KnpLabs/php-github-api/blob/master/doc/users.md#get-repos-that-a-specific-user-is-watching
# There is a Laravel friendly version of it
# https://github.com/GrahamCampbell/Laravel-GitHub
###
Scenario: Press button to get starred repos
  Given I am logged in
  And I setup my token
  Then I will see a button to get starred repos
  And if I have not set my token this will be grayed out
  And if I click that it will say "Getting your data" while it makes the request
  And axios will make a request to a protected api route on our app that then will call github to get the data
  And when it gets the starred repos it will show them on the home page
```

Coverage: authentication, vuejs, axios requests, components and security



Build this on your machine with

  * .env - DB_DATABASE, DB_USERNAME, DB_PASSWORD, GITHUB_TOKEN 
  * composer install
  * npm install && npm run dev


## Notes on Controllers
Laravels single action controllers
Business logic kept in appropriate sharable Class


## Small commits with PRs

## Tests
Feature Tests with PHPUnit 

Test Driven Development

  * mocking interactions with API Classes.
  * only used the Refreshdatabase as needed
  * Facade mocking used instead of hiting api

## Screenshots

![Add Github Token](https://raw.githubusercontent.com/chiefbrob/interview_foundation/master/public/images/screenshot1.png)

![Github Token added](https://raw.githubusercontent.com/chiefbrob/interview_foundation/master/public/images/screenshot2.png)

![Get Starred Repos](https://raw.githubusercontent.com/chiefbrob/interview_foundation/master/public/images/screenshot3.png)

![Getting your data](https://raw.githubusercontent.com/chiefbrob/interview_foundation/master/public/images/screenshot4.png)

![Your Starred Repositories](https://raw.githubusercontent.com/chiefbrob/interview_foundation/master/public/images/screenshot5.png)

