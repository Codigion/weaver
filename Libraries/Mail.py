# Weaver Framework - Mail Script
#
# Usage:
# python3 Mail.py recipient@example.com 'Hello World' '<p>This is a test email.</p>'

import smtplib
import ssl
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
import sys
import os

def loadEnvironmentVariables(filePath):
    """
    Load environment variables from a .env file.

    Args:
        filePath (str): Path to the .env file.

    Returns:
        str: The sender's email address.
        str: The sender's email password.
        str: The environment name.
    """
    try:
        with open(filePath, 'r') as envFile:
            lines = envFile.readlines()

        envVars = {}
        for line in lines:
            line = line.strip()
            if line and '=' in line:
                key, value = line.split('=', 1)
                envVars[key] = value

        senderEmail = envVars.get('SENDER_EMAIL', '')
        password = envVars.get('SENDER_PASSWORD', '')
        environment = envVars.get('ENVIRONMENT', '')

        return senderEmail, password, environment
    except Exception as e:
        print(f"Error loading environment variables: {str(e)}")
        return None, None, None

def sendEmail(environment, senderEmail, password, receiverEmail, subject, htmlMessage):
    """
    Send an email.

    Args:
        environment (str): Code environment.
        senderEmail (str): The sender's email address.
        password (str): The sender's email password.
        receiverEmail (str): The recipient's email address.
        subject (str): The email subject.
        htmlMessage (str): The HTML content of the email.

    Returns:
        None
    """
    try:
        message = MIMEMultipart("alternative")
        message["Subject"] = subject
        message["From"] = senderEmail
        message["To"] = receiverEmail

        htm = MIMEText(htmlMessage, "html")
        message.attach(htm)

        context = ssl.create_default_context()

        if environment == 'development':
            context.check_hostname = False
            context.verify_mode = ssl.CERT_NONE

        with smtplib.SMTP_SSL("smtpout.secureserver.net", 465, context=context) as server:
            server.login(senderEmail, password)
            server.sendmail(senderEmail, receiverEmail, message.as_string())

        print(f"Email sent successfully to: {receiverEmail}")
    except Exception as e:
        print(f"Failed to send email to {receiverEmail}: {str(e)}")

try:
    senderEmail, password, environment = loadEnvironmentVariables('Configurations/.env')
    if senderEmail and password:
        receiverEmail = sys.argv[1]
        subject = sys.argv[2]
        htmlMessage = sys.argv[3]
        if not senderEmail or not password or not environment:
            print("Error: SENDER_EMAIL, SENDER_PASSWORD, or ENVIRONMENT not defined.")
        else:
            sendEmail(environment, senderEmail, password, receiverEmail, subject, htmlMessage)
    else:
        print("Error: SENDER_EMAIL or SENDER_PASSWORD not found in .env file.")
except IndexError:
    print(f"Usage: {sys.argv[0]} <To> <Subject> <Message[html]>")
