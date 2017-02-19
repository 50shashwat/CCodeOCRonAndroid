# CCodeOCRonAndroid
Android Project with Backend local server of apache2 running php . The OCR is done on Matlab and the image is transferred to the server.

<h2>Before You Run Server Code</h2>
<h3>Pre-Requisite Softwares For Windows Machine:</h3>

<ul>
<li>Xampp</li>
<li>Matlab 2013+</li>
<li>Python 2.7</li>
<li>CodeBlocks</li>
</ul>

Step 1: Install all these above software. Open XAMPP control panel and start apache server.

Step 2: Add Path variable for Matlab/bin folder and Codeblocks/bin folder to access gcc and matlab command.

Step 3: Copy the server code in `C:\xampp\htdocs\server`.

Step 4: Connect your test smartphone on the same network as the PC and get your PC's ipaddress by using command `ipconfig`

Step 5: Open Up the Android Code in Android Studio (Install all the sdk build tools for compiling)

Step 6: Edit the `MainActivity.java` file and rename the `serverUrl` variable to point your PC's laptop.

Step 7: You can check whether server is working by typing the ipaddress of PC from step 4 in smartphone which opens the XAMPP default page.

Step 8: Upload the sample image from the sample image folder in server by using the browse button.



You can raise issue in the code if you find any bugs. :)
