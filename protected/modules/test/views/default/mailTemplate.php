大家都知道 <?php echo $test;?>

C#

中的

System.Net.Mail.SmtpClient

类是专门用来请求

SMTP

服务器发送邮件的，

但是如

果使用本地的

SMTP

服务器

（比如本机

IIS

的

SMTP

服务器）发送邮件，会被许多大型网站的邮箱当做垃

圾邮件来处理，原因是本地

SMTP

服务器的地址并不为人所知，发送的邮件理所当然会被当做来历不明的

邮件，

所以我们要借助一些大型知名网站的

SMTP

服务器来为我们发送邮件，

这里就向大家介绍使用

163

的

SMTP

服务器发送邮件的方法。

 

PS:

使用

163

的

SMTP

服务器发送邮件会使得你开发系统所发送的邮件都使用

163

的邮箱地址作为发信

人的地址，但是我认为这总比把邮件每次都发送到用户的垃圾邮件箱要强，因为如果你发送的邮件全是垃

圾邮件，用户可能根本就不会去看你发送的是什么，就把邮件删掉了，这才是最糟糕的

....