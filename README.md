# silex-demo
A small demo of putting together a lightweight application based on the micro-framework silex 
## description
The main use case to be solved is a simple subscription form where one can enter a name and an email address. When the user has subscribed on the page, 
she is sent to a confirmation page where the entered details are shown. In conjunction with the subscription there should be send a confirmation to 
the given email as well as it should write this action to a log file.

## criteria for development of the application
* It should use Twig for the HTML part
* It should be able to send emails using Swiftmailer
* It should be well structured
* It should be conform to PSR-0 and PSR-1 coding standards
* It should be using composer to manage dependencies
* It should contain test using PHPUnit
* Input should be validated using Symfony validator component
* It should be able to install on a vagrant machine using chef solo provisioner

## prerequisites
The project is set up to be installed on a vagrant machine which is provisioned by 
In order to run this demo you have to vagrant and virtualbox installed. On my Ubuntu 14.04 i did:

    sudo apt-get install vagrant virtualbox-4.3
## installation
The installation will attempt to forward ports 8081 and 8085 to the vagrant box, if needed this can be edited in the Vagrantfile.
Clone the repo and run vagrant up:

    git clone git@github.com:johi/silex-demo.git
    cd silex-demo
    vagrant up

## running the demo
In order to see the app in your browser visit [http://127.0.0.1:8081](http://127.0.0.1:8081)

In order to see that a mail has been sent visit [http://127.0.0.1:8085](http://127.0.0.1:8085)

