import smtplib, ssl
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

def posliEmailNeg(server, port, sender, password, recipient):
    message = MIMEMultipart("alternative")
    message["Subject"] = "Varovanie prsanie"
    message["From"] = sender
    message["To"] = recipient
    html = """\
        <html>
            <body>
                <h1>Varovanie vo vasom sklenniku je momentalne vysoka teplota
            </body>
            </html> """
    part2 = MIMEText(html, "html")
    message.attach(part2)

    context = ssl.create_default_context()
    with smtplib.SMTP_SSL(server, port, context=context) as Emailserver:
        Emailserver.login(sender, password)
        Emailserver.sendmail(
            sender, recipient, message.as_string()
        )


def posliEmailPozit(server, port, sender, password, recipient):
    message = MIMEMultipart("alternative")
    message["Subject"] = "Varovanie prsanie"
    message["From"] = sender
    message["To"] = recipient
    html = """\
        <html>
            <body>
                <h1>Poplach ukonceny voda sa nachadza v pode</h1>
            </body>
            </html> """
    part2 = MIMEText(html, "html")
    message.attach(part2)

    context = ssl.create_default_context()
    with smtplib.SMTP_SSL(server, port, context=context) as Emailserver:
        Emailserver.login(sender, password)
        Emailserver.sendmail(
            sender, recipient, message.as_string()
        )

def SendEmail(server, port, sender, password, recipient):
    message = MIMEMultipart("alternative")
    message["Subject"] = "Varovanie prsanie"
    message["From"] = sender
    message["To"] = recipient
    html = """\
            <html>
                <body>
                    <h1>Moznost zrazok, schovajte pradlo</h1>
                </body>
                </html> """
    part2 = MIMEText(html, "html")
    message.attach(part2)

    context = ssl.create_default_context()
    with smtplib.SMTP_SSL(server, port, context=context) as Emailserver:
        Emailserver.login(sender, password)
        Emailserver.sendmail(
            sender, recipient, message.as_string()
        )