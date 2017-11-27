<h1>Change your document root to the public_html folder!</h1>
<h3>Windows with WampServer</h3>
<p>In order to change your document root in wamp (if you are on Windows):</p>
<ul>
  <li><b>Stop</b> WampServer if running</li>
  <li><b>Navigate</b> to C:\wamp\bin\apache\Apache2.2.11\conf and open httpd.conf</li>
  <li><b>Scroll</b> down to the line containting <b>DocumentRoot "c:/wamp/www"</b></li>
  <li><b>Change</b> the path from "c:/wamp/www" to "c:/wamp/www/blog.team624.org/public_html"</li>
  <li><b>Scroll</b> down to the line containting <b>&lt;Directory "c:/wamp/www"&gt;</b></li>
  <li><b>Change</b> the path from "c:/wamp/www" to "c:/wamp/www/blog.team624.org/public_html"</li>
  <li><b>Save</b> the file and Start WampServer</li>
</ul>
<br>
<h3>Linux with XAMPP</h3>
<p>In order to change your document root in XAMPP (if you are on Linux):</p>
<ul>
  <li><b>Stop</b> XAMPP by typing <b><u>sudo /opt/lampp/lampp stop</u></b> into the terminal</li>
  <li><b>Open</b> httpd.conf by typing <b><u>sudo gedit /opt/lampp/etc/httpd.conf</u></b> into the terminal<br>You have to type in your password because it is write protected</li>
  <li><b>Scroll</b> down to the line containting <b>DocumentRoot "/opt/lampp/htdocs"</b></li>
  <li><b>Change</b> the path from "/opt/lampp/htdocs" to "/opt/lampp/htdocs/blog.team624.org/public_html"</li>
  <li><b>Scroll</b> down to the line containting <b>&lt;Directory "/opt/lampp/htdocs"&gt;</b></li>
  <li><b>Change</b> the path from "/opt/lampp/htdocs" to "/opt/lampp/htdocs/blog.team624.org/public_html"</li>
  <li><b>Save</b> the file</li>
  <li><b>Start</b> XAMPP by typing <b><u>sudo /opt/lampp/lampp start</u></b> into the terminal</li>
</ul>
