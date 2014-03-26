<?php
  // Build out URI to reload from form dropdown
  // Need full url for this to work in Opera Mini
  $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";

  if (isset($_POST['sg_uri']) && isset($_POST['sg_section_switcher'])) {
     $pageURL .= $_POST[sg_uri].$_POST[sg_section_switcher];
     header("Location: $pageURL");
  }

  // Display title of each markup samples as a select option
  function listMarkupAsOptions ($type) {
    $files = array();
    $handle=opendir('markup/'.$type);
    while (false !== ($file = readdir($handle))):
        if(stristr($file,'.html')):
            $files[] = $file;
        endif;
    endwhile;

    sort($files);
    foreach ($files as $file):
        $filename = preg_replace("/\.html$/i", "", $file);
        $title = preg_replace("/\-/i", " ", $filename);
        $title = ucwords($title);
        echo '<option value="#sg-'.$filename.'">'.$title.'</option>';
    endforeach;
  }

  // Display markup view & source
  function showMarkup($type) {
    $files = array();
    $handle=opendir('markup/'.$type);
    while (false !== ($file = readdir($handle))):
        if(stristr($file,'.html')):
            $files[] = $file;
        endif;
    endwhile;

    sort($files);
    foreach ($files as $file):
        $filename = preg_replace("/\.html$/i", "", $file);
        $title = preg_replace("/\-/i", " ", $filename);
        echo '<div class="sg-markup sg-section">';
        echo '<div class="sg-display">';
        echo '<h2 id="sg-'.$filename.'" class="sg-h2">'.$title.'</h2>';
        include('markup/'.$type.'/'.$file);
        echo '</div>';
        echo '<div class="sg-markup-controls"><a class="sg-btn sg-btn--source" href="#">View Source</a>  </div>';
        echo '<div class="sg-source sg-animated">';
        echo '<a class="sg-btn sg-btn--select" href="#">Copy Source</a>';
        echo '<pre class="prettyprint linenums"><code>';
        echo htmlspecialchars(file_get_contents('markup/'.$type.'/'.$file));
        echo '</code></pre>';
        echo '</div>';
        echo '</div>';
    endforeach;
  }
?>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
  <meta charset="utf-8">
  <title>Style Guide</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Style Guide Boilerplate Styles -->
  <link rel="stylesheet" href="css/sg-style.css">

  <!-- Replace below stylesheet with your own stylesheet -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div id="top" class="sg-header sg-container">
  <h1 class="sg-logo">Style Guide / Pattern Library</h1>
  <form id="js-sg-nav" action=""  method="post" class="sg-nav">
    <select id="js-sg-section-switcher" class="sg-section-switcher" name="sg_section_switcher">
        <option value="">Jump To Section:</option>
        <optgroup label="Intro">
          <option value="#sg-about">About</option>
          <option value="#sg-colors">Colors</option>
          <option value="#sg-fontStacks">Font-Stacks</option>
        </optgroup>
        <optgroup label="Base Styles">
          <?php listMarkupAsOptions('base'); ?>
        </optgroup>
        <optgroup label="Pattern Styles">
          <?php listMarkupAsOptions('patterns'); ?>
        </optgroup>
        <optgroup label="Helper Styles">
          <?php listMarkupAsOptions('helpers'); ?>
        </optgroup>
        <optgroup label="Templates">
          <option value="#sg-basic-home-template">Basic Home Template</option>
          <option value="#sg-basic-full-width-template">Basic Full Width Template</option>
          <option value="#sg-basic-dual-sidebars-template">Basic Dual Sidebars Template</option>
          <option value="#sg-basic-left-sidebar-template">Basic Left Sidebar Template</option>
          <option value="#sg-basic-right-sidebar-template">Basic Right SidebarTemplate</option>
        </optgroup>
    </select>
    <input type="hidden" name="sg_uri" value="<?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>">
    <button type="submit" class="sg-submit-btn">Go</button>
  </form><!--/.sg-nav-->
</div><!--/.sg-header-->

<div class="sg-body sg-container">
  <div class="sg-info">
    <div class="sg-about sg-section">
      <h2 class="sg-h2" id="sg-about">About</h2>
      <p>This Style Guide / Pattern Library contains standard design patterns for websites. The idea behind this is to build <a href="http://daverupert.com/2013/04/responsive-deliverables/" title="Responsive Deliverables - daverupert.com" target="_blank">"Modules" not "Pages"</a>. The implementation of this Style Guide / Pattern Library provides reusable code ("Modules") to build website pages.</p>
      <p>These Modules (excluding Base Styles) are designed to be applied to any html tag(s). It's up to you to use <a href="http://nicolasgallagher.com/about-html-semantics-front-end-architecture/?codekitCB=413870998.513274" title="About HTML semantics and front-end architecture – Nicolas Gallagher" target="_blank">semantic html markup</a>. Please see the <a href="http://www.w3.org/TR/html5/" title="HTML5" target="_blank">W3C HTML 5 Specication</a> if you have doubts on which html tags you should use. </p>
      <p>To install this Style Guide for a specific website — upload the parent directory "style-guide" via FTP to the web root directory of the website. e.g. http://yoursite.com/style-guide/</p>
    </div><!--/.sg-about-->

    <div class="sg-conventions sg-section">
      <h2 class="sg-h2" id="sg-conventions">Coding Conventions and Guidelines</h2>
      <ul>
        <li>The CSS code naming methodoly is based on <a href="http://api.yandex.com/bem/" title="BEM. Block, Element, Modifier" target="_blank">BEM</a> (Block, Element, Modifier).</li>
        <li>The categorization and organization of the CSS rules are based on <a href="http://smacss.com/book/" title="Book - Scalable and Modular Architecture for CSS" target="_blank">SMACSS</a> (Scalable and Modular Architecture for CSS) methodology.</li>
        <li>The depth of applicability is the number of generations that are affected by a given CSS rule. The maximum depth of applicability for Modules should be no more than 3 generations. Any higher than that would cause a much greater dependencity on a particular HTML structure.</li>
        <li>Modules should not depend on other modules.</li>
        <li>CSS class names should communicate useful information to developers and must convey information about the architectural structure of the component.</li>
        <li>Each Module is built using the Mobile First approach.</li>
        <li>Each Module should degrade graceully in IE 8 and above</li>
      </ul>
    </div><!--/.sg-conventions-->

    <div class="sg-tools sg-section">
      <h2 class="sg-h2" id="sg-tools">Tools &amp; Resources</h2>
      <ul>
        <li><a href="http://html5boilerplate.com/" title="HTML5 Boilerplate: The web&#x27;s most popular front-end template" target="_blank">HTML5 Boiler Plate</a>: A good starting point for any html document. (make sure to use the latest version of normalize.css)</li>
        <li><a href="http://necolas.github.io/normalize.css/" title="Normalize.css: Make browsers render all elements more consistently." target="_blank">normalize.css</a>: makes browser render all elements more consitiently.</li>
        <li><a href="http://html5please.com/" title="HTML5 Please - Use the new and shiny responsibly" target="_blank">HTML5 Please</a>: Look up HTML5 CSS3 features and know if they are ready for use.</li>
        <li><a href="http://caniuse.com/" title="Can I use... Support tables for HTML5, CSS3, etc" target="_blank">Can I Use&hellip;</a>: is another tool like HTML5 Please</li>
        <li><a href="http://modularscale.com/" title="Modular Scale" target="_blank">Modular Scale</a>: For composing more meaningful typography &amp; layouts.</li>
        <li><a href="http://sass-lang.com/" title="Sass: Syntactically Awesome Style Sheets" target="_blank">Sass</a>: CSS with super powers</li>
        <li><a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element" title="HTML element reference - HTML | MDN">Mozilla</a>: HTML Reference</li>
        <li><a href="http://andrew.hedges.name/experiments/aspect_ratio/">Aspect Ratio Calculator</a>: for figuring out image proportions.</li>
      </ul>
    </div><!--/.sg-tools-->

    <div class="sg-colors sg-section">
      <h2 class="sg-h2" id="sg-colors">Colors</h2>
        <div class="sg-color sg-color--a"><span class="sg-color-swatch"><span class="sg-animated">#001F3F</span></span></div>
        <div class="sg-color sg-color--b"><span class="sg-color-swatch"><span class="sg-animated">#0074D9</span></span></div>
        <div class="sg-color sg-color--c"><span class="sg-color-swatch"><span class="sg-animated">#7FDBFF</span></span></div>
        <div class="sg-color sg-color--d"><span class="sg-color-swatch"><span class="sg-animated">#39CCCC</span></span></div>
        <div class="sg-color sg-color--e"><span class="sg-color-swatch"><span class="sg-animated">#3D9970</span></span></div>
        <div class="sg-color sg-color--f"><span class="sg-color-swatch"><span class="sg-animated">#2ECC40</span></span></div>
        <div class="sg-color sg-color--g"><span class="sg-color-swatch"><span class="sg-animated">#01FF70</span></span></div>
        <div class="sg-color sg-color--h"><span class="sg-color-swatch"><span class="sg-animated">#FFDC00</span></span></div>
        <div class="sg-color sg-color--i"><span class="sg-color-swatch"><span class="sg-animated">#FF851B</span></span></div>
        <div class="sg-color sg-color--j"><span class="sg-color-swatch"><span class="sg-animated">#FF4136</span></span></div>
        <div class="sg-color sg-color--k"><span class="sg-color-swatch"><span class="sg-animated">#85144B</span></span></div>
        <div class="sg-color sg-color--l"><span class="sg-color-swatch"><span class="sg-animated">#B10DC9</span></span></div>
        <div class="sg-color sg-color--m"><span class="sg-color-swatch"><span class="sg-animated">#ffffff</span></span></div>
        <div class="sg-color sg-color--n"><span class="sg-color-swatch"><span class="sg-animated">#b2b2b2</span></span></div>
        <div class="sg-color sg-color--o"><span class="sg-color-swatch"><span class="sg-animated">#6d6d6d</span></span></div>
        <div class="sg-color sg-color--p"><span class="sg-color-swatch"><span class="sg-animated">#303030</span></span></div>
        <div class="sg-color sg-color--q"><span class="sg-color-swatch"><span class="sg-animated">#111111</span></span></div>
        <div class="sg-markup-controls"></div>
    </div><!--/.sg-colors-->

    <div class="sg-font-stacks sg-section">
      <h2 class="sg-h2" id="sg-fontStacks">Font Stacks</h2>
      <p class="sg-font sg-font-primary">"HelveticaNeue", "Helvetica", Arial, sans-serif;</p>
      <p class="sg-font sg-font-secondary">Georgia, Times, "Times New Roman", serif;</p>
      <div class="sg-markup-controls"></div>
    </div><!--/.sg-font-stacks-->
  </div><!--/.sg-info-->

  <div class="sg-base-styles">
    <h1 class="sg-h1">Base Styles</h1>
    <?php showMarkup('base'); ?>
  </div><!--/.sg-base-styles-->

  <div class="sg-pattern-styles">
    <h1 class="sg-h1">Pattern Styles</h1>
    <?php showMarkup('patterns'); ?>
  </div><!--/.sg-pattern-styles-->

  <div class="sg-helper-styles">
    <h1 class="sg-h1">Helper Styles</h1>
    <?php showMarkup('helpers'); ?>
  </div><!--/.sg-helper-styles-->

  <div class="sg-template-styles">
    <h1 id="sg-templates">Templates</h1>

    <div class="sg-markup sg-section">
      <div class="sg-display">
        <h2 id="sg-basic-full-width-template" class="sg-h2">Basic Full Width Template</h2>
        <p>Some verbiage about Basic Full Width template. <a href="templates/basic-full-width.html" target="_blank">View</a></p>
      </div>
    </div>

    <div class="sg-markup sg-section">
      <div class="sg-display">
        <h2 id="sg-basic-dual-sidebars-template" class="sg-h2">Basic Dual Sidebars Template</h2>
        <p>Some verbiage about Basic Dual Sidebars template. <a href="templates/basic-dual-sidebars.html" target="_blank">View</a></p>
      </div>
    </div>

    <div class="sg-markup sg-section">
      <div class="sg-display">
        <h2 id="sg-basic-left-sidebar-template" class="sg-h2">Basic Left Sidebar Template</h2>
        <p>Some verbiage about Basic Left Sidebar template. <a href="templates/basic-left-sidebar.html" target="_blank">View</a></p>
      </div>
    </div>

    <div class="sg-markup sg-section">
      <div class="sg-display">
        <h2 id="sg-basic-right-sidebar-template" class="sg-h2">Basic Right Sidebar Template</h2>
        <p>Some verbiage about Basic Right Sidebar template. <a href="templates/basic-right-sidebar.html" target="_blank">View</a></p>
      </div>
    </div>

    <div class="sg-markup sg-section">
      <div class="sg-display">
        <h2 id="sg-basic-home-template" class="sg-h2">Basic Home Template</h2>
        <p>Some verbiage about Basic Home template. <a href="templates/basic-home.html" target="_blank">View</a></p>
      </div>
    </div>

  </div><!--/.sg-template-styles-->

</div><!--/.sg-body-->

  <script src="js/sg-plugins.js"></script>
  <script src="js/sg-scripts.js"></script>
</body>
</html>