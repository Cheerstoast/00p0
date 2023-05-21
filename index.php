<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAA/50zAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABERAAAAAAARERERAAAAAREREREQAAABERABERAAABERARAREQAAEREBEBERAAAREQEQEREAABERARAREQAAAREQAREQAAABERERERAAAAARERERAAAAAAAREQAAAAAAAAAAAAAAAAAAAAAAAAD//wAA//8AAPw/AADwDwAA4AcAAOGHAADCQwAAwkMAAMJDAADCQwAA4YcAAOAHAADwDwAA/D8AAP//AAD//wAA">
  <title>00p0.repl.co</title>
  <style>
    *,*::before,*::after {
      box-sizing: border-box;
      padding: 0;
      margin: 0;
    }
    body {
      width: 100vw;
      background-size: cover;
      user-select: none;
    }
    ul {
      margin: auto;
      width: 99%;
      height: 100%;
      padding-inline-start: 0;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(10rem, 1fr));
      grid-auto-rows: auto;
      grid-auto-flow: dense;
    }
    li {
      display: flex;
      font-size: calc(0.5em + 0.7rem);
      font-family: serif !important;
      border: 1px solid rgb(218,220,224);
      border-radius: 10px;
      text-align: center;
      margin: 1%;
      overflow: hidden;
      white-space: nowrap;
    }
    svg {
      margin-left: -1.33rem;
      position: absolute;
      width: calc(0.5em + 0.7rem);
    }
    a {
      width: 100%;
      height: 100%;
      color: rgb(60,64,67) !important;
      text-decoration: none;
      padding: 4% 1.6rem 4%;
      font-family: Arial;
    }
    a:hover {
      background-color: rgba(218,220,224,0.4);
    }
    .file {
      order: 2;
    }
    .folder {
      order: 1;
    }
    .usage-bar {
      width: 100vw;
      height: 1rem;
      border: 1px solid rgb(218,220,224);
    }
    .usage {
      width: 0%;
      height: 100%;
      background-color: rgb(218,220,224);
    }
    nav {
      display: flex;
    }
    button {
      display: flex;
      align-items: center;
      width: 2rem;
      height: 2rem;
      border-radius: 1rem;
      border: none;
      background-color: transparent;
      cursor: pointer;
    }
    button:hover {
      background-color: rgba(218,220,224,0.4);
    }
    button svg {
      margin-left: 0.35rem;
      width: 1.3rem;
      height: 1.3rem;
    }
    .right {
      margin-left: auto;
    }
    .file-upload-overlay {
      display: none;
      position: absolute;
      background-color: rgba(0,0,0,0.3) !important;
      z-index: 1;
      padding: 5rem 10vw 5rem;
    }
    form {
      background-color: #FFF;
      border: 1px solid floralwhite;
      padding: none;
      margin-bottom: -10px;
      z-index: 2;
    }
    ::file-selector-button {
      opacity: 0.01;
      position: absolute;
      width: 100%;
      height: 50vh;
      cursor: pointer;
      border: none;
    }
    #fileselectprompt {
      padding-left: 0.2rem;
      position: absolute;
      font-family: Monaco;
      font-size: 0.85rem;
    }
    #fileselectoverlay {
      width: 100%;
      height: 50vh;
      overflow: hidden;
      text-align: center;
    }
    #fileselectoverlaycontent {
      height: 100%;
      border: 3px dotted #56E5FF;
      padding-top: 20vh;;
      font-family: Monaco;
    }
    input {
      width: 100%;
      padding-left: 7.7rem;
      font-family: Monaco;
      display: inline-block;
    }
    input[type=submit] {
      width: 100%;
      height: 10vh;
      background-color: #56E5FF;
      color: white;
      padding: 14px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
      transition: all 0.1s ease-in-out;
    }
    
    input[type=submit]:hover {
      background-color: #45E3FF;
      box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
      transform: scale(1.03);
    }
    #makenew {
      position: absolute;
      margin-left: 3rem;
      margin-top: 2rem;
      width: 6rem;
      display: none;
      z-index: 1;
      background-color: white;
    }
    .option {
      width: 100%;
    }
    #newfolderoverlay {
      display: none;
      position: absolute;
      background-color: rgba(0,0,0,0.3) !important;
      z-index: 1;
      padding: 5rem 10vw 5rem;
    }
    label {
      position: absolute;
      padding-left: 3px;
      font-family: Monaco;
    }
    #example {
      width: 100%;
      font-family: Monaco;
      border: 3px dotted #56E5FF;
    }
  </style>
  
</head>

<body>
  
    <?php 
    // Used space variable
    $usedspace = 0;
  
    // Directory variable; get from "path" if set
    $dir = $_GET['path'];if(empty($dir)){$dir = '.';}
  
    // // Log directories and their sizes in the console
    // exec("cd $dir && du -h -x -s -- * | sort -r -h", $output);foreach($output as $line) {echo("<script>console.log('$line');</script>");}



echo "<a id='newfolderoverlay' href='?path=$dir'><div id='newfolderform'></div><form action='?path=$dir' method='post'><label for='example'>Folder name:</label><input style='display: none' type='text' name='textremembered' /><input required type='text' id='example' name='example'><input type='submit' value='CREATE'></form></a>";
echo "<a class='file-upload-overlay overlay' href='?path=$dir'><div id='fileuploadform'></div><form class='' action='?path=$dir&upload=upload' method='post' enctype='multipart/form-data'>";

?>
    <div id="fileselectprompt">Upload a file:</div>
    <input required type="file" name="fileToUpload" id="fileToUpload" onchange="form.submit()"></input>
    <div id='fileselectoverlay'><div id='fileselectoverlaycontent'>Drop file here or<br/><u>choose a file</u></div></div>
    <input id="submit" type="submit" value="UPLOAD" name="submit">
    </form>
  </a>
  <!-- Storage usage bar -->
  <div class="usage-bar"><div class="usage"></div></div>
  <!-- Navigation bar with a few buttons with icons in it -->
  <nav><button onclick="location.href='/';"><svg version="1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" enable-background="new 0 0 48 48"><polygon fill="#2196F3" points="42,39 6,39 6,23 24,6 42,23"/><g fill="#2196F3"><polygon points="39,21 34,16 34,9 39,9"/><rect x="6" y="39" width="36" height="5"/></g><polygon fill="#2196F3" points="24,4.3 4,22.9 6,25.1 24,8.4 42,25.1 44,22.9"/><rect x="18" y="28" fill="#FFF" width="12" height="16"/><rect x="21" y="17" fill="#FFF" width="6" height="6"/><path fill="#2196F3" d="M27.5,35.5c-0.3,0-0.5,0.2-0.5,0.5v2c0,0.3,0.2,0.5,0.5,0.5S28,38.3,28,38v-2C28,35.7,27.8,35.5,27.5,35.5z"/></svg></button><button onclick='togglemakenew()''><svg version="1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" enable-background="new 0 0 48 48"><rect x="20.5" y="10" fill="#2196F3" width="7" height="28"/><rect x="10" y="20.5" fill="#2196F3" width="28" height="7"/></svg></button><div id='makenew'>
    <button class='option' onclick='togglemakenewfolder()'>New folder</button><button class='option'>Create new file</button><button class='option' onclick='toggleupload()'>Upload new file</button>
  </div><button onclick="location.href='/';" class="right"><svg version="1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" enable-background="new 0 0 48 48"><circle fill="#2196F3" cx="24" cy="24" r="21"/><rect x="22" y="22" fill="#fff" width="4" height="11"/><circle fill="#fff" cx="24" cy="16.5" r="2.5"/></svg></button></nav>

  <!-- Unordered list containing all the shown directories  -->
  <ul>

  <?php
  // SVG images stored as PHP string variables.
  // More than a dozen images are stored this way; and together they take less than 20KB.
  $filesvg = "<svg version='1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 48 48' enable-background='new 0 0 48 48'><polygon fill='#90CAF9' points='40,45 8,45 8,3 30,3 40,13'/><polygon fill='#E1F5FE' points='38.5,14 29,14 29,4.5'/><g fill='#1976D2'><rect x='16' y='21' width='17' height='2'/><rect x='16' y='25' width='13' height='2'/><rect x='16' y='29' width='17' height='2'/><rect x='16' y='33' width='13' height='2'/></g></svg>";$imagesvg = "<svg class='svg-icon' style='width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;' viewBox='0 0 1024 1024' version='1.1' xmlns='http://www.w3.org/2000/svg'><path d='M952.888889 281.6V910.222222c0 62.862222-50.915556 113.777778-113.777778 113.777778H156.444444c-62.862222 0-113.777778-50.915556-113.777777-113.777778V113.777778c0-62.862222 50.915556-113.777778 113.777777-113.777778h514.844445L952.888889 281.6z' fill='#85BCFF' /><path d='M676.664889 167.822222V0l281.6 281.6h-167.822222c-62.862222 0-113.777778-50.915556-113.777778-113.777778' fill='#529EE0' /><path d='M685.824 363.804444a53.76 53.76 0 0 1 53.731556 53.731556v307.029333a53.76 53.76 0 0 1-53.731556 53.731556H309.76a53.731556 53.731556 0 0 1-53.731556-53.76V417.564444c0-29.667556 24.035556-53.731556 53.731556-53.731555H685.795556z m-72.903111 149.674667l-138.183111 146.545778-80.583111-62.805333-92.131556 94.208v31.402666c0 11.548444 10.325333 20.906667 23.04 20.906667h345.400889c12.714667 0 23.04-9.386667 23.04-20.906667v-125.610666l-80.583111-83.740445z m-227.896889-85.532444a32.085333 32.085333 0 1 0 0 64.142222 32.085333 32.085333 0 0 0 0-64.142222z' fill='#FFFFFF' /></svg>";$spreadsheetsvg = "<svg class='svg-icon' style='width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;' viewBox='0 0 1024 1024' version='1.1' xmlns='http://www.w3.org/2000/svg'><path d='M967.111111 281.6V910.222222c0 62.577778-51.2 113.777778-113.777778 113.777778H170.666667c-62.577778 0-113.777778-51.2-113.777778-113.777778V113.777778c0-62.577778 51.2-113.777778 113.777778-113.777778h514.844444L967.111111 281.6z' fill='#62C558' /><path d='M685.511111 224.711111V0L967.111111 281.6H742.4c-31.288889 0-56.888889-25.6-56.888889-56.888889' fill='#2A8121' /><path d='M682.666667 724.024889L638.691556 768 341.333333 470.670222 385.308444 426.666667zM454.087111 611.128889l44.088889 44.088889L385.422222 768 341.333333 723.911111zM682.666667 470.755556l-113.066667 113.066666-44.088889-44.088889L638.577778 426.666667z' fill='#FFFFFF' /></svg>";$pdfsvg = "<svg class='svg-icon' style='width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;' viewBox='0 0 1024 1024' version='1.1' xmlns='http://www.w3.org/2000/svg'><path d='M967.111111 281.6V910.222222c0 62.577778-51.2 113.777778-113.777778 113.777778H170.666667c-62.577778 0-113.777778-51.2-113.777778-113.777778V113.777778c0-62.577778 51.2-113.777778 113.777778-113.777778h514.844444L967.111111 281.6z' fill='#D23B41' /><path d='M685.511111 224.711111V0L967.111111 281.6H742.4c-31.288889 0-56.888889-25.6-56.888889-56.888889' fill='#9C171C' /><path d='M680.277333 662.698667c-11.889778-1.194667-23.751111-3.640889-35.640889-9.728 10.666667-2.133333 20.110222-2.133333 30.776889-2.133334 23.751111 0 28.330667 5.774222 28.330667 9.443556-6.997333 2.417778-15.246222 3.356444-23.466667 2.417778z m-120.945777-15.530667c-25.884444 5.802667-54.556444 14.336-80.440889 23.779556v-2.446223l-2.446223 1.223111c13.084444-26.197333 25.002667-53.333333 35.640889-80.753777l0.938667 1.223111 1.194667-2.133334c13.112889 20.110222 29.866667 40.220444 47.530666 57.884445h-3.640889l1.223112 1.223111zM497.777778 417.450667c1.223111-1.223111 3.669333-1.223111 4.551111-1.223111h3.697778a96.739556 96.739556 0 0 1-1.251556 61.553777c-8.220444-18.915556-11.861333-40.220444-6.997333-60.330666zM352.142222 770.275556l-3.669333 1.223111a96.768 96.768 0 0 1 42.666667-34.417778c-9.443556 15.502222-22.556444 27.392-38.997334 33.194667z m324.494222-155.107556c-25.002667 0-49.664 3.669333-74.666666 8.248889a353.365333 353.365333 0 0 1-73.415111-94.776889c20.110222-66.417778 21.333333-111.217778 5.774222-132.551111a39.253333 39.253333 0 0 0-30.748445-15.502222c-15.246222-1.223111-29.582222 6.087111-36.579555 18.887111-21.333333 35.640889 9.443556 105.415111 23.779555 134.058666-16.782222 50.887111-36.864 99.328-63.089777 146.858667-112.412444 48.440889-114.858667 77.994667-114.858667 88.661333 0 13.084444 7.310222 26.197333 20.110222 32 4.864 3.640889 11.889778 4.835556 17.976889 4.835556 29.582222 0 64-33.194667 100.551111-98.389333 46.307556-18.887111 92.615111-34.133333 141.084445-44.8a153.941333 153.941333 0 0 0 87.722666 35.356444c20.110222 0 59.107556 0 59.107556-40.220444 1.223111-15.530667-6.997333-41.443556-62.748445-42.666667z' fill='#FFFFFF' /></svg>";$videosvg = "<svg class='svg-icon' style='width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;' viewBox='0 0 1024 1024' version='1.1' xmlns='http://www.w3.org/2000/svg'><path d='M967.111111 281.6V910.222222c0 62.862222-50.915556 113.777778-113.777778 113.777778H170.666667c-62.862222 0-113.777778-50.915556-113.777778-113.777778V113.777778c0-62.862222 50.915556-113.777778 113.777778-113.777778h514.844444L967.111111 281.6z' fill='#C386F0' /><path d='M284.444444 398.222222m42.666667 0l298.666667 0q42.666667 0 42.666666 42.666667l0 234.666667q0 42.666667-42.666666 42.666666l-298.666667 0q-42.666667 0-42.666667-42.666666l0-234.666667q0-42.666667 42.666667-42.666667Z' fill='#FFFFFF' /><path d='M738.417778 457.841778a31.971556 31.971556 0 0 1 48.014222 27.676444v154.538667c0 24.632889-26.652444 40.021333-47.985778 27.704889L684.430222 636.586667V488.96z' fill='#FFFFFF' /><path d='M685.511111 167.822222V0L967.111111 281.6H799.288889c-62.862222 0-113.777778-50.915556-113.777778-113.777778' fill='#A15FDE' /></svg>";$musicsvg = "<svg class='svg-icon' style='width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;' viewBox='0 0 1024 1024' version='1.1' xmlns='http://www.w3.org/2000/svg'><path d='M967.111111 281.6V910.222222c0 62.862222-50.915556 113.777778-113.777778 113.777778H170.666667c-62.862222 0-113.777778-50.915556-113.777778-113.777778V113.777778c0-62.862222 50.915556-113.777778 113.777778-113.777778h514.844444L967.111111 281.6z' fill='#A15FDE' /><path d='M685.511111 196.266667V0L967.111111 281.6H770.844444a85.333333 85.333333 0 0 1-85.333333-85.333333' fill='#C386F0' /><path d='M669.980444 426.268444v236.999112c0 26.254222-31.857778 47.587556-71.082666 47.587555-39.253333 0-70.741333-21.333333-70.741334-47.587555 0-26.282667 31.516444-47.587556 70.741334-47.587556 14.848 0 28.728889 3.100444 40.163555 8.334222v-165.916444l-205.767111 48.497778v211.057777c0 26.254222-32.142222 47.559111-71.992889 47.559111-39.850667 0-72.305778-21.333333-72.305777-47.559111 0-26.282667 32.426667-47.587556 72.305777-47.587555a96.711111 96.711111 0 0 1 41.102223 8.647111V474.168889c0-14.222222 9.870222-26.88 23.779555-29.980445l205.795556-47.900444a30.862222 30.862222 0 0 1 38.001777 29.980444' fill='#FFFFFF' /></svg>";$docxsvg = "<svg class='svg-icon' style='width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;' viewBox='0 0 1024 1024' version='1.1' xmlns='http://www.w3.org/2000/svg'><path d='M967.111111 281.6V910.222222c0 62.577778-51.2 113.777778-113.777778 113.777778H170.666667c-62.577778 0-113.777778-51.2-113.777778-113.777778V113.777778c0-62.577778 51.2-113.777778 113.777778-113.777778h514.844444L967.111111 281.6z' fill='#4F6BF6' /><path d='M581.262222 755.626667h59.363556L739.555556 439.04h-59.335112z' fill='#FFFFFF' /><path d='M685.511111 224.711111V0L967.111111 281.6H742.4c-31.288889 0-56.888889-25.6-56.888889-56.888889' fill='#243EBB' /><path d='M640.625778 755.626667h-59.363556l-98.929778-277.020445h59.335112zM442.737778 755.626667h-59.363556L284.444444 439.04h59.335112z' fill='#FFFFFF' /><path d='M383.374222 755.626667h59.363556l98.929778-277.020445h-59.335112z' fill='#FFFFFF' /></svg>";$pptsvg = "<svg class='svg-icon' style='width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;' viewBox='0 0 1024 1024' version='1.1' xmlns='http://www.w3.org/2000/svg'><path d='M967.111111 281.6V910.222222c0 62.577778-51.2 113.777778-113.777778 113.777778H170.666667c-62.577778 0-113.777778-51.2-113.777778-113.777778V113.777778c0-62.577778 51.2-113.777778 113.777778-113.777778h514.844444L967.111111 281.6z' fill='#F16C41' /><path d='M685.511111 224.711111V0L967.111111 281.6H742.4c-31.288889 0-56.888889-25.6-56.888889-56.888889' fill='#CD4B29' /><path d='M525.880889 648.135111a88.32 88.32 0 0 1-68.750222-32.995555 87.04 87.04 0 0 1-19.626667-55.381334c0-21.048889 7.253333-40.248889 19.626667-55.381333a88.234667 88.234667 0 0 1 68.750222-32.995556 88.490667 88.490667 0 0 1 88.376889 88.376889 88.519111 88.519111 0 0 1-88.376889 88.376889m0-235.690667c-24.945778 0-48.327111 6.087111-68.750222 17.294223a143.075556 143.075556 0 0 0-58.88 56.945777v146.119112a143.132444 143.132444 0 0 0 58.88 56.974222c20.423111 11.178667 43.804444 17.265778 68.750222 17.265778a147.342222 147.342222 0 0 0 147.285333-147.285334 147.342222 147.342222 0 0 0-147.285333-147.342222' fill='#FFFFFF' /><path d='M398.222222 824.888889h58.908445V412.444444H398.222222z' fill='#FFFFFF' /></svg>";$archivesvg = "<svg class='svg-icon' style='width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;' viewBox='0 0 1024 1024' version='1.1' xmlns='http://www.w3.org/2000/svg'><path d='M967.111111 281.6V910.222222c0 62.862222-50.915556 113.777778-113.777778 113.777778H170.666667c-62.862222 0-113.777778-50.915556-113.777778-113.777778V113.777778c0-62.862222 50.915556-113.777778 113.777778-113.777778h514.844444L967.111111 281.6z' fill='#FFC63A' /><path d='M685.511111 167.822222V0L967.111111 281.6H799.288889c-62.862222 0-113.777778-50.915556-113.777778-113.777778' fill='#DD9F08' /><path d='M436.565333 68.437333h68.437334V0h-68.437334zM505.002667 136.874667h68.437333V68.437333h-68.437333zM436.565333 205.312h68.437334V136.874667h-68.437334zM505.002667 273.749333h68.437333V205.312h-68.437333z' fill='#FFFFFF' /><path d='M436.565333 342.158222h68.437334V273.720889h-68.437334zM505.002667 410.624h68.437333V342.186667h-68.437333z' fill='#FFFFFF' /><path d='M436.565333 479.032889h68.437334v-68.437333h-68.437334zM505.002667 547.470222h68.437333v-68.437333h-68.437333zM470.784 762.225778h68.437333v-68.437334h-68.437333v68.437334z m-34.218667-136.874667v136.874667c0 18.915556 15.331556 34.218667 34.218667 34.218666h68.437333c18.915556 0 34.218667-15.303111 34.218667-34.218666v-136.874667h-136.874667z' fill='#FFFFFF' /></svg>";$websvg = "<svg class='svg-icon' style='width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;' viewBox='0 0 1024 1024' version='1.1' xmlns='http://www.w3.org/2000/svg'><path d='M952.888889 281.6V910.222222c0 62.862222-50.915556 113.777778-113.777778 113.777778H156.444444c-62.862222 0-113.777778-50.915556-113.777777-113.777778V113.777778c0-62.862222 50.915556-113.777778 113.777777-113.777778h514.844445L952.888889 281.6z' fill='#58C5C2' /><path d='M511.146667 294.656l0.711111 0.142222a246.044444 246.044444 0 0 1 0 491.292445 17.92 17.92 0 0 1-5.688889 0.284444h-0.995556l-7.395555 0.113778a246.044444 246.044444 0 1 1 8.391111-491.946667 17.237333 17.237333 0 0 1 4.977778 0.113778z m-98.986667 355.271111l-92.501333 0.028445a209.180444 209.180444 0 0 0 144.896 96.938666 334.961778 334.961778 0 0 1-52.394667-96.938666z m263.736889 0.028445H592.497778a337.92 337.92 0 0 1-50.062222 94.776888 209.351111 209.351111 0 0 0 133.461333-94.776888z m-122.737778 0h-101.603555a298.069333 298.069333 0 0 0 51.2 85.248c21.902222-26.026667 38.684444-54.897778 50.403555-85.248z m-155.534222-159.288889h-102.968889A209.578667 209.578667 0 0 0 288.711111 540.444444c0 25.486222 4.551111 49.92 12.913778 72.533334h100.181333a338.773333 338.773333 0 0 1-4.181333-122.311111z m171.832889 0.028444h-134.4a301.511111 301.511111 0 0 0 4.721778 122.282667h125.013333c9.813333-40.078222 11.377778-81.720889 4.664889-122.282667z m131.413333 0h-93.980444a342.186667 342.186667 0 0 1-4.152889 122.282667h91.192889A208.64 208.64 0 0 0 706.844444 540.444444c0-17.152-2.076444-33.820444-5.973333-49.777777z m-236.288-156.728889l-0.711111 0.142222A209.351111 209.351111 0 0 0 307.484444 453.688889h97.735112a334.705778 334.705778 0 0 1 59.335111-119.694222z m38.200889 11.719111l-3.868444 4.579556a298.012444 298.012444 0 0 0-55.239112 103.452444h117.248a301.397333 301.397333 0 0 0-58.140444-108.032z m39.651556-9.528889l4.295111 5.831112a338.062222 338.062222 0 0 1 52.622222 111.701333h88.689778a209.464889 209.464889 0 0 0-145.607111-117.532445z' fill='#FFFFFF' /><path d='M676.664889 167.822222V0l281.6 281.6h-167.822222c-62.862222 0-113.777778-50.915556-113.777778-113.777778' fill='#2B9592' /></svg>";$ebooksvg = "<svg style='width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Capa_1'  viewBox='0 0 455 455' xml:space='preserve'><path style='fill:#185F8D;' d='M363.75,0H91.25c-16.5,0-30,13.5-30,30v395c0,16.5,13.5,30,30,30h272.5c16.5,0,30-13.5,30-30V30   C393.75,13.5,380.25,0,363.75,0z'/><polygon style='fill:#FFFFFF;' points='363.76,30 363.76,395 91.24,395 91.26,29.98  '/><path style='fill:#082947;' d='M242.501,432.502h-30c-4.142,0-7.5-3.358-7.5-7.5s3.358-7.5,7.5-7.5h30c4.143,0,7.5,3.358,7.5,7.5   S246.644,432.502,242.501,432.502z'/><path style='fill:#185F8D;' d='M323.763,77.479h-192.5c-4.142,0-7.5-3.358-7.5-7.5s3.358-7.5,7.5-7.5h192.5   c4.143,0,7.5,3.358,7.5,7.5S327.906,77.479,323.763,77.479z'/><path style='fill:#185F8D;' d='M323.763,113.106h-192.5c-4.142,0-7.5-3.358-7.5-7.5s3.358-7.5,7.5-7.5h192.5   c4.143,0,7.5,3.358,7.5,7.5S327.906,113.106,323.763,113.106z'/><path style='fill:#185F8D;' d='M227.513,148.734h-96.25c-4.142,0-7.5-3.358-7.5-7.5s3.358-7.5,7.5-7.5h96.25   c4.143,0,7.5,3.358,7.5,7.5S231.656,148.734,227.513,148.734z'/><path style='fill:#185F8D;' d='M323.763,184.362h-192.5c-4.142,0-7.5-3.358-7.5-7.5s3.358-7.5,7.5-7.5h192.5   c4.143,0,7.5,3.358,7.5,7.5S327.906,184.362,323.763,184.362z'/><path style='fill:#185F8D;' d='M323.763,219.99h-192.5c-4.142,0-7.5-3.358-7.5-7.5s3.358-7.5,7.5-7.5h192.5   c4.143,0,7.5,3.358,7.5,7.5S327.906,219.99,323.763,219.99z'/><path style='fill:#185F8D;' d='M323.763,255.618h-192.5c-4.142,0-7.5-3.358-7.5-7.5s3.358-7.5,7.5-7.5h192.5   c4.143,0,7.5,3.358,7.5,7.5S327.906,255.618,323.763,255.618z'/><path style='fill:#185F8D;' d='M323.763,291.246h-192.5c-4.142,0-7.5-3.358-7.5-7.5s3.358-7.5,7.5-7.5h192.5   c4.143,0,7.5,3.358,7.5,7.5S327.906,291.246,323.763,291.246z'/><path style='fill:#185F8D;' d='M323.763,326.874h-192.5c-4.142,0-7.5-3.358-7.5-7.5s3.358-7.5,7.5-7.5h192.5   c4.143,0,7.5,3.358,7.5,7.5S327.906,326.874,323.763,326.874z'/><path style='fill:#185F8D;' d='M227.513,362.502h-96.25c-4.142,0-7.5-3.358-7.5-7.5s3.358-7.5,7.5-7.5h96.25   c4.143,0,7.5,3.358,7.5,7.5S231.656,362.502,227.513,362.502z'/></g></svg>";$foldersvg = "<svg version='1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 48 48' enable-background='new 0 0 48 48'><path fill='#FFA000' d='M40,12H22l-4-4H8c-2.2,0-4,1.8-4,4v8h40v-4C44,13.8,42.2,12,40,12z'/><path fill='#FFCA28' d='M40,12H8c-2.2,0-4,1.8-4,4v20c0,2.2,1.8,4,4,4h32c2.2,0,4-1.8,4-4V16C44,13.8,42.2,12,40,12z'/></svg>";
  // End of images. Phew.

  // PHP function - send file via POST
  function sendfile($file) {
    $target_url = "https://0.00p0.repl.co/upload";
    $cfile = new CURLFile(realpath($file));
    $post = array ('file' => $cfile);$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $target_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
    curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: multipart/form-data'));
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 100);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $result = curl_exec ($ch);curl_close ($ch);
    if (str_contains($result,"[")){return ($result);} else { return "failed";}
  }
  if (!str_contains($dir,'..')){
    // Arrays of file extensions to check
    $hidden = array('.','index.php','.replit','replit.nix','.cache');
    $archives = array('.7z','.tar.bz2','.tar.gz','.rar','.zip','.zipx');
    $musics = array('.mp3','.m4a','.wav','.ogg','.pcm','wma','.alac','.flac');
    $videos = array('.mp4','.mov','.wmv','.flv','.avi','.webm','.mkv');
    $images = array('.png','.jpg','.jpeg','.psd','.tif','.bmp');
  
    // Delicate process to output <li> list items with corresponding <a> links inside, and also display SVG icon and directory name
    // This took a long time to perfect.
    $files = scandir($dir);
    foreach ($files as $file) {
      if (!in_array($file, $hidden)) {
        if (is_file("$dir/$file")) {
          // Remember $usedspace set at the start? Now append size of files to it
          $usedspace = $usedspace + filesize("$dir/$file");
          // Which SVG icon should be used?
          $usesvg = $filesvg;
          if (str_contains($file, '.html')) {$usesvg = $websvg;}
          if (str_contains($file, '.pdf')) {$usesvg = $pdfsvg;}
          if (str_contains($file, '.ppt')) {$usesvg = $pptsvg;}
          if (str_contains($file, '.doc')) {$usesvg = $docxsvg;}
          if (str_contains($file, '.xls')) {$usesvg = $spreadsheetsvg;}
          if (str_contains($file, '.azw') or str_contains($file, '.epub') or str_contains($file, '.mobi')) {$usesvg = $ebooksvg;}foreach ($archives as $archive){if (str_contains($file, $archive)){$usesvg = $archivesvg;}}foreach ($musics as $music){if (str_contains($file, $music)){$usesvg = $musicsvg;}}foreach ($videos as $video){if (str_contains($file, $video)){$usesvg = $videosvg;}}foreach ($images as $image){if (str_contains($file, $image)){$usesvg = $imagesvg;}}
  
          // Display the file as a <li> list.
          echo "<li class='file'><a href='/$dir/$file' download>$usesvg$file</a></li>";
  
        } else {
          // If dealing with a folder:
          if ((strcmp("$dir/$file", "./..") !== 0)) {
            // Get the files of the folder and add them all to $usedspace
            $subfiles = scandir("$dir/$file");
            foreach ($subfiles as $subfile) {
              $usedspace = $usedspace + filesize("$dir/$file/$subfile");}
            // What should be the link for the <a> link?
            // It is the parent of $dir; or if not then it is the child of $dir.
            if ($file == ".."){$link = dirname("$dir");} else {$link = "$dir/$file";}
            // Display the folder as a <li> list.
            echo "<li class='folder'><a href='?path=$link'>$foldersvg$file</a></li>";
          }
        }
      }
    }
  }
  ?>
  </ul>

<?php
  $usedspaceMB = round($usedspace / 1000000,2);
  $usedspaceGB = round($usedspaceMB / 10000,2);
  $percentage = round($usedspaceMB / 10);

if(isset($_POST['example'])) {
  $example = $_POST['example'];
  if(!is_dir("$dir/$example") and !str_contains($example,"/")){
    mkdir("$dir/$example");
    echo "<script>window.alert('The folder \"$example\" was created.');window.location='?path=$dir'</script>";
    
  } else {
    echo "<script>window.alert('The folder \"$example\" was not created.');window.location='?path=$dir'</script>";
  }
}
  if ($_GET["upload"] == "upload"){
    $target_dir = $_GET['path'] . "/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      // If upload successful, get file name, and show notice. Then reload $dir
      $file = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
      echo "<script>window.alert('$file was uploaded.');window.location='?path=$dir'</script>";
    } else {
      // If upload successful, show notice. Then go back with history.back()
      echo "<script>window.alert('Upload failed. :(');history.back()</script>";
    }
  }
  echo "<script>document.querySelector('.usage').style.width = '$percentage%'</script>";

?>



<!-- <?php

if (isset($_POST['save'])) {
    $contents = $_POST['contents'];
    file_put_contents('0.txt', $contents);
    echo 'File saved successfully!';
}

$contents = file_get_contents('0.txt');

?>

<form method="post">
    <textarea name="contents"><?php echo $contents; ?></textarea><br>
    <input type="submit" name="save" value="Save">
</form> -->


<script>
    // Make everything undraggable
    document.addEventListener("dragstart", function(event) {event.preventDefault();}, false);


    var buttons = document.getElementsByClassName("file");
    for (var i = 0; i < buttons.length; i++) {
      buttons[i].addEventListener("contextmenu", function(){
        (this.nextElementSibling.style.display === "block") ? "none" : "block";
      });
    }

  
    // This line of code cancels the "Confirm Form Resubmission" prompt
    if (window.history.replaceState) {window.history.replaceState( null, null, window.location.href );}
    var newfolderinput = document.getElementById("example");
    newfolderinput.addEventListener('click', (e) => {e.preventDefault();});
    var form = document.getElementById("fileuploadform");
    form.addEventListener('click', (e) => {e.preventDefault();});
    var fileselectorbutton = document.getElementById("fileselectoverlay");
    fileselectorbutton.addEventListener('click', (e) => {event.returnValue = true;});


    // Set local storage items
    localStorage.setItem("makenew", "no");
    localStorage.setItem("newfolderoverlay", "no");
    localStorage.setItem("upload", "no");


    // Toggle make new file function
    function togglemakenew() {
    	if (localStorage.getItem("makenew") === "no") {
        localStorage.setItem("makenew", "yes");
        document.getElementById("makenew").style.display = 'block';
      } else {
        localStorage.setItem("makenew", "no");
        document.getElementById("makenew").style.display = 'none';
      }
    }
    function togglemakenewfolder() {
    	if (localStorage.getItem("newfolderoverlay") === "no") {
        localStorage.setItem("newfolderoverlay", "yes");
        document.getElementById("newfolderoverlay").style.display = 'block';
      } else {
        localStorage.setItem("newfolderoverlay", "no");
        document.getElementById("newfolderoverlay").style.display = 'none';
      }
      localStorage.setItem("makenew", "no");
      document.getElementById("makenew").style.display = 'none';
    }
    // Toggle upload function
    function toggleupload() {
    	if (localStorage.getItem("upload") === "no") {
        localStorage.setItem("upload", "yes");
        document.getElementsByClassName("file-upload-overlay")[0].style.display = 'block';
      } else {
        localStorage.setItem("upload", "no");
        document.getElementsByClassName("file-upload-overlay")[0].style.display = 'none';
      }
      localStorage.setItem("makenew", "no");
      document.getElementById("makenew").style.display = 'none';
    }
  
</script>

</body>
</html>
