# Interview Foundation Build


[![Build Status](https://travis-ci.org/alnutile/interview_foundation.svg?branch=master)](https://travis-ci.org/alnutile/interview_foundation)

This is a vanilla Laravel 7 install

What I will want is for you to complete the following tasks so I can then review the work.


## The business story to complete

We try to write our stories in Gherkin so I will do that below. It does not mean
you need to turn this into a test

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
  
Scenario: Dealing with 500 or bad token
  Given I am logged in
  And my token is setup
  And I click Get data but the token is no longer valid
  Then I should see a bootvuejs Toast message letting me know the error
```

So you can see from above we are dealing with authentication, vuejs
axios requests, components and security.

And most importantly PHPUnit test that mock the interactions with the API Classes

I should be able to build this on my machine with

  * composer install
  * npm install && npm run dev


## Fork the repo
Make sure to fork it this way I can look over later.

## Keep Controllers small
Use Laravels single action controllers (see docs)
Make sure controllers are small and business logic is in a sharable class


## Work in small commits
I do not want to see what big code dump I want you to push often using PRs
As you take small steps and write tests push (more on this in a moment)


## Sign up for TravisCI and setup it up to run per build
With this you have to get your .travis.yml file to run the PHPunit tests etc
This build is already working in travis so it should be pretty easy and this .travis
file should get you going

Update your readme Travis badge to match your build

## Tests
This feature will require some testing, those tests should only use the
Refreshdatabase as needed.

Test should not hit the api use Facade mocking for that

