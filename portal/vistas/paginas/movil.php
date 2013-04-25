<html lang="en" class="ui-mobile"><head>
    <meta charset="utf-8">
    <title>Form</title>
    <meta content="width=device-width" name="viewport">

    <!--jQuery References-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

    <!--Theme-->
    <link title="rocket-jqueryui" type="text/css" rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css">

    <!--Wijmo Widgets CSS-->
    <link type="text/css" rel="stylesheet" href="http://cdn.wijmo.com/jquery.wijmo-pro.all.3.20131.2.min.css">

    <!--Wijmo Widgets JavaScript-->
    <script type="text/javascript" src="http://cdn.wijmo.com/jquery.wijmo-open.all.3.20131.2.min.js"></script>
    <script type="text/javascript" src="http://cdn.wijmo.com/jquery.wijmo-pro.all.3.20131.2.min.js"></script>
</head>
<body class="ui-mobile-viewport ui-overlay-b">
    <div data-theme="b" data-role="page" data-url="/C:/xampp/htdocs/tc/web/libs/wijmo32/Samples/WidgetExplorerMobile/samples/appview/widgets/index.html" tabindex="0" class="ui-page ui-body-b ui-page-active" style="min-height: 77px;">
        <div data-role="wijappview" class="wijmo-wijappview wijmo-wijappview-with-fixed-header wijmo-wijappview-in-page"><div class="wijmo-wijappview-page-container"><div data-title="Form" data-role="appviewpage" data-external-page="true" class="wijmo-wijappview-page wijmo-wijappview-page-active" data-url="file:///C:/xampp/htdocs/tc/web/libs/wijmo32/Samples/WidgetExplorerMobile/samples/appview/widgets/form.html"><div data-role="header" class="wijmo-wijappview-header ui-header-fixed ui-header ui-bar-a" role="banner"><a href="file:///C:/xampp/htdocs/tc/web/libs/wijmo32/Samples/WidgetExplorerMobile/samples/appview/widgets/index.html" data-icon="back" class="ui-btn-left ui-btn ui-btn-up-a ui-shadow ui-btn-corner-all ui-btn-icon-left" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-theme="a"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text">Back</span><span class="ui-icon ui-icon-back ui-icon-shadow">&nbsp;</span></span></a><h2 class="ui-title" role="heading" aria-level="1">Form</h2></div>
    <div data-role="content" class="wijmo-wijappview-content ui-content" role="main">
        <form method="get" action="#">

			<h2>Form elements</h2>

			<p>This page contains various progressive-enhancement driven form controls. Native elements are sometimes hidden from view, but their values are maintained so the form can be submitted normally. Browsers that don't support the custom controls will still deliver a usable experience because all are based on native form elements.</p>
			
			<p>There is a complete set of <a href="file:///C:/xampp/htdocs/tc/web/libs/wijmo32/Samples/WidgetExplorerMobile/samples/appview/widgets/forms-all-mini.html" class="ui-link">mini-sized</a> form elements which are useful for toolbars or tighter spaces. <a href="file:///C:/xampp/htdocs/tc/web/libs/wijmo32/Samples/WidgetExplorerMobile/samples/appview/widgets/forms-all-compare.html" class="ui-link">Compare mini and normal</a> form elements side-by-side.</p>

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br"><label for="name" class="ui-input-text">Text Input:</label><input type="text" value="" id="name" name="name" class="ui-input-text ui-body-b ui-corner-all ui-shadow-inset"></div>

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br"><label for="textarea" class="ui-input-text">Textarea:</label><textarea id="textarea" name="textarea" rows="8" cols="40" class="ui-input-text ui-body-b ui-corner-all ui-shadow-inset"></textarea></div>

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br"><label for="search" class="ui-input-text">Search Input:</label><div class="ui-input-search ui-shadow-inset ui-btn-corner-all ui-btn-shadow ui-icon-searchfield ui-body-b"><input type="text" data-type="search" value="" id="search" name="password" class="ui-input-text ui-body-b"><a title="clear text" class="ui-input-clear ui-btn ui-btn-up-b ui-shadow ui-btn-corner-all ui-fullsize ui-btn-icon-notext ui-input-clear-hidden" href="#" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="delete" data-iconpos="notext" data-theme="b" data-mini="false"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text">clear text</span><span class="ui-icon ui-icon-delete ui-icon-shadow">&nbsp;</span></span></a></div></div>

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br"><label for="slider2" id="slider2-label" class="ui-slider">Flip switch:</label><select data-role="slider" id="slider2" name="slider2" class="ui-slider-switch">
					<option value="off">Off</option>
					<option value="on">On</option>
				</select><div role="application" class="ui-slider ui-slider-switch ui-btn-down-b ui-btn-corner-all"><span class="ui-slider-label ui-slider-label-a ui-btn-active ui-btn-corner-all" role="img" style="width: 0%;">On</span><span class="ui-slider-label ui-slider-label-b ui-btn-down-b ui-btn-corner-all" role="img" style="width: 100%;">Off</span><div class="ui-slider-inneroffset"><a href="#" class="ui-slider-handle ui-btn ui-shadow ui-btn-corner-all ui-slider-handle-snapping ui-btn-up-b" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-theme="b" role="slider" aria-valuemin="0" aria-valuemax="1" aria-valuenow="off" aria-valuetext="Off" title="Off" aria-labelledby="slider2-label" style="left: 0%;"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text"></span></span></a></div></div></div>

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br"><label for="slider" class="ui-input-text ui-slider" id="slider-label">Slider:</label><input type="number" data-type="range" data-highlight="true" max="100" min="0" value="50" id="slider" name="slider" class="ui-input-text ui-body-b ui-corner-all ui-shadow-inset ui-slider-input"><div role="application" class="ui-slider  ui-btn-down-b ui-btn-corner-all"><div class="ui-slider-bg ui-btn-active ui-btn-corner-all" style="width: 50%;"></div><a href="#" class="ui-slider-handle ui-btn ui-btn-up-b ui-shadow ui-btn-corner-all" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-theme="b" role="slider" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50" aria-valuetext="50" title="50" aria-labelledby="slider-label" style="left: 50%;"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text"></span></span></a></div></div>

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br"><fieldset data-role="controlgroup" class="ui-corner-all ui-controlgroup ui-controlgroup-vertical"><div class="ui-controlgroup-label" role="heading">Choose as many snacks as you'd like:</div><div class="ui-controlgroup-controls">
				
				<div class="ui-checkbox"><input type="checkbox" class="custom" id="checkbox-1a" name="checkbox-1a"><label for="checkbox-1a" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="checkbox-off" data-theme="b" class="ui-btn ui-btn-up-b ui-btn-icon-left ui-checkbox-off ui-corner-top"><span class="ui-btn-inner ui-corner-top"><span class="ui-btn-text">Cheetos</span><span class="ui-icon ui-icon-checkbox-off ui-icon-shadow">&nbsp;</span></span></label></div>
				

				<div class="ui-checkbox"><input type="checkbox" class="custom" id="checkbox-2a" name="checkbox-2a"><label for="checkbox-2a" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="checkbox-off" data-theme="b" class="ui-btn ui-btn-up-b ui-btn-icon-left ui-checkbox-off"><span class="ui-btn-inner"><span class="ui-btn-text">Doritos</span><span class="ui-icon ui-icon-checkbox-off ui-icon-shadow">&nbsp;</span></span></label></div>
				

				<div class="ui-checkbox"><input type="checkbox" class="custom" id="checkbox-3a" name="checkbox-3a"><label for="checkbox-3a" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="checkbox-off" data-theme="b" class="ui-btn ui-btn-up-b ui-btn-icon-left ui-checkbox-off"><span class="ui-btn-inner"><span class="ui-btn-text">Fritos</span><span class="ui-icon ui-icon-checkbox-off ui-icon-shadow">&nbsp;</span></span></label></div>
				

				<div class="ui-checkbox"><input type="checkbox" class="custom" id="checkbox-4a" name="checkbox-4a"><label for="checkbox-4a" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="checkbox-off" data-theme="b" class="ui-btn ui-btn-up-b ui-btn-icon-left ui-checkbox-off ui-corner-bottom ui-controlgroup-last"><span class="ui-btn-inner ui-corner-bottom ui-controlgroup-last"><span class="ui-btn-text">Sun Chips</span><span class="ui-icon ui-icon-checkbox-off ui-icon-shadow">&nbsp;</span></span></label></div>
				
		    </div></fieldset></div>

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br"><fieldset data-type="horizontal" data-role="controlgroup" class="ui-corner-all ui-controlgroup ui-controlgroup-horizontal"><div class="ui-controlgroup-label" role="heading">Font styling:</div><div class="ui-controlgroup-controls">
		    	
		    	<div class="ui-checkbox"><input type="checkbox" class="custom" id="checkbox-6" name="checkbox-6"><label for="checkbox-6" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-theme="b" class="ui-btn ui-btn-up-b ui-checkbox-off ui-corner-left"><span class="ui-btn-inner ui-corner-left"><span class="ui-btn-text">b</span></span></label></div>
				

				<div class="ui-checkbox"><input type="checkbox" class="custom" id="checkbox-7" name="checkbox-7"><label for="checkbox-7" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-theme="b" class="ui-btn ui-btn-up-b ui-checkbox-off"><span class="ui-btn-inner"><span class="ui-btn-text"><em>i</em></span></span></label></div>
				

				<div class="ui-checkbox"><input type="checkbox" class="custom" id="checkbox-8" name="checkbox-8"><label for="checkbox-8" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-theme="b" class="ui-btn ui-btn-up-b ui-checkbox-off ui-corner-right ui-controlgroup-last"><span class="ui-btn-inner ui-corner-right ui-controlgroup-last"><span class="ui-btn-text">u</span></span></label></div>
				
		    </div></fieldset></div>

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br"><fieldset data-role="controlgroup" class="ui-corner-all ui-controlgroup ui-controlgroup-vertical"><div class="ui-controlgroup-label" role="heading">Choose a pet:</div><div class="ui-controlgroup-controls">
			    	
			         	<div class="ui-radio"><input type="radio" checked="checked" value="choice-1" id="radio-choice-1" name="radio-choice-1"><label for="radio-choice-1" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="radio-off" data-theme="b" class="ui-btn ui-btn-icon-left ui-radio-on ui-corner-top ui-btn-up-b"><span class="ui-btn-inner ui-corner-top"><span class="ui-btn-text">Cat</span><span class="ui-icon ui-icon-shadow ui-icon-radio-on">&nbsp;</span></span></label></div>
			         	

			         	<div class="ui-radio"><input type="radio" value="choice-2" id="radio-choice-2" name="radio-choice-1"><label for="radio-choice-2" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="radio-off" data-theme="b" class="ui-btn ui-btn-up-b ui-btn-icon-left ui-radio-off"><span class="ui-btn-inner"><span class="ui-btn-text">Dog</span><span class="ui-icon ui-icon-radio-off ui-icon-shadow">&nbsp;</span></span></label></div>
			         	

			         	<div class="ui-radio"><input type="radio" value="choice-3" id="radio-choice-3" name="radio-choice-1"><label for="radio-choice-3" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="radio-off" data-theme="b" class="ui-btn ui-btn-up-b ui-btn-icon-left ui-radio-off"><span class="ui-btn-inner"><span class="ui-btn-text">Hamster</span><span class="ui-icon ui-icon-radio-off ui-icon-shadow">&nbsp;</span></span></label></div>
			         	

			         	<div class="ui-radio"><input type="radio" value="choice-4" id="radio-choice-4" name="radio-choice-1"><label for="radio-choice-4" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="radio-off" data-theme="b" class="ui-btn ui-btn-icon-left ui-radio-off ui-corner-bottom ui-controlgroup-last ui-btn-up-b"><span class="ui-btn-inner ui-corner-bottom ui-controlgroup-last"><span class="ui-btn-text">Lizard</span><span class="ui-icon ui-icon-radio-off ui-icon-shadow">&nbsp;</span></span></label></div>
			         	
			    </div></fieldset></div>

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br"><fieldset data-type="horizontal" data-role="controlgroup" class="ui-corner-all ui-controlgroup ui-controlgroup-horizontal"><div class="ui-controlgroup-label" role="heading">Layout view:</div><div class="ui-controlgroup-controls">
			     	
			         	<div class="ui-radio"><input type="radio" checked="checked" value="on" id="radio-choice-c" name="radio-choice-b"><label for="radio-choice-c" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-theme="b" class="ui-btn ui-btn-up-b ui-radio-on ui-btn-active ui-corner-left"><span class="ui-btn-inner ui-corner-left"><span class="ui-btn-text">List</span></span></label></div>
			         	
			         	<div class="ui-radio"><input type="radio" value="off" id="radio-choice-d" name="radio-choice-b"><label for="radio-choice-d" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-theme="b" class="ui-btn ui-btn-up-b ui-radio-off"><span class="ui-btn-inner"><span class="ui-btn-text">Grid</span></span></label></div>
			         	
			         	<div class="ui-radio"><input type="radio" value="other" id="radio-choice-e" name="radio-choice-b"><label for="radio-choice-e" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-theme="b" class="ui-btn ui-btn-up-b ui-radio-off ui-corner-right ui-controlgroup-last"><span class="ui-btn-inner ui-corner-right ui-controlgroup-last"><span class="ui-btn-text">Gallery</span></span></label></div>
			         	
			    </div></fieldset></div>

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br"><label class="select ui-select" for="select-choice-1">Choose shipping method:</label><div class="ui-select"><div data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="arrow-d" data-iconpos="right" data-theme="b" class="ui-btn ui-btn-up-b ui-shadow ui-btn-corner-all ui-btn-icon-right"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text"><span>Standard: 7 day</span></span><span class="ui-icon ui-icon-arrow-d ui-icon-shadow">&nbsp;</span></span><select id="select-choice-1" name="select-choice-1">
					<option value="standard">Standard: 7 day</option>
					<option value="rush">Rush: 3 days</option>
					<option value="express">Express: next day</option>
					<option value="overnight">Overnight</option>
				</select></div></div></div>

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br"><label class="select ui-select" for="select-choice-3">Your state:</label><div class="ui-select"><div data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="arrow-d" data-iconpos="right" data-theme="b" class="ui-btn ui-btn-up-b ui-shadow ui-btn-corner-all ui-btn-icon-right"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text"><span>Alabama</span></span><span class="ui-icon ui-icon-arrow-d ui-icon-shadow">&nbsp;</span></span><select id="select-choice-3" name="select-choice-3">
					<option value="AL">Alabama</option>
					<option value="AK">Alaska</option>
					<option value="AZ">Arizona</option>
					<option value="AR">Arkansas</option>
					<option value="CA">California</option>
					<option value="CO">Colorado</option>
					<option value="CT">Connecticut</option>
					<option value="DE">Delaware</option>
					<option value="FL">Florida</option>
					<option value="GA">Georgia</option>
					<option value="HI">Hawaii</option>
					<option value="ID">Idaho</option>
					<option value="IL">Illinois</option>
					<option value="IN">Indiana</option>
					<option value="IA">Iowa</option>
					<option value="KS">Kansas</option>
					<option value="KY">Kentucky</option>
					<option value="LA">Louisiana</option>
					<option value="ME">Maine</option>
					<option value="MD">Maryland</option>
					<option value="MA">Massachusetts</option>
					<option value="MI">Michigan</option>
					<option value="MN">Minnesota</option>
					<option value="MS">Mississippi</option>
					<option value="MO">Missouri</option>
					<option value="MT">Montana</option>
					<option value="NE">Nebraska</option>
					<option value="NV">Nevada</option>
					<option value="NH">New Hampshire</option>
					<option value="NJ">New Jersey</option>
					<option value="NM">New Mexico</option>
					<option value="NY">New York</option>
					<option value="NC">North Carolina</option>
					<option value="ND">North Dakota</option>
					<option value="OH">Ohio</option>
					<option value="OK">Oklahoma</option>
					<option value="OR">Oregon</option>
					<option value="PA">Pennsylvania</option>
					<option value="RI">Rhode Island</option>
					<option value="SC">South Carolina</option>
					<option value="SD">South Dakota</option>
					<option value="TN">Tennessee</option>
					<option value="TX">Texas</option>
					<option value="UT">Utah</option>
					<option value="VT">Vermont</option>
					<option value="VA">Virginia</option>
					<option value="WA">Washington</option>
					<option value="WV">West Virginia</option>
					<option value="WI">Wisconsin</option>
					<option value="WY">Wyoming</option>
				</select></div></div></div>

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br"><label class="select ui-select" for="select-choice-a">Choose shipping method:</label><div class="ui-select"><a href="#" role="button" id="select-choice-a-button" aria-haspopup="true" aria-owns="select-choice-a-menu" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="arrow-d" data-iconpos="right" data-theme="b" class="ui-btn ui-btn-up-b ui-shadow ui-btn-corner-all ui-btn-icon-right"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text"><span>Custom menu example</span></span><span class="ui-icon ui-icon-arrow-d ui-icon-shadow">&nbsp;</span></span></a><select data-native-menu="false" id="select-choice-a" name="select-choice-a" tabindex="-1">
					<option data-placeholder="true">Custom menu example</option>
					<option value="standard">Standard: 7 day</option>
					<option value="rush">Rush: 3 days</option>
					<option value="express">Express: next day</option>
					<option value="overnight">Overnight</option>
				</select><div style="display: none;"><!-- placeholder --></div></div></div>

		<div class="ui-body ui-body-b">
		<fieldset class="ui-grid-a">
				<div class="ui-block-a"><div data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="null" data-iconpos="null" data-theme="d" class="ui-btn ui-btn-up-d ui-shadow ui-btn-corner-all ui-submit" aria-disabled="false"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text">Cancel</span></span><button data-theme="d" type="submit" class="ui-btn-hidden" aria-disabled="false">Cancel</button></div></div>
				<div class="ui-block-b"><div data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="null" data-iconpos="null" data-theme="a" class="ui-btn ui-btn-up-a ui-shadow ui-btn-corner-all ui-submit" aria-disabled="false"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text">Submit</span></span><button data-theme="a" type="submit" class="ui-btn-hidden" aria-disabled="false">Submit</button></div></div>
	    </fieldset>
		</div>
	</form>
    </div>
</div></div>
            
            <div class="ui-body-a wijmo-wijappview-menu" data-role="menu">
                <ul data-theme="a" data-role="listview" class="ui-listview">
                    <li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="arrow-r" data-iconpos="right" data-theme="a" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-a"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="basics.html" class="ui-link-inherit">Basics</a></div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span></div></li>
                    <li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="arrow-r" data-iconpos="right" data-theme="a" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-a"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="listview.html" class="ui-link-inherit">List View</a></div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span></div></li>
                    <li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="arrow-r" data-iconpos="right" data-theme="a" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-li-last ui-btn-up-a ui-btn-down-b"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="form.html" class="ui-link-inherit">Form</a></div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span></div></li>
                </ul>
            </div>
        </div>
    <div class="ui-screen-hidden ui-popup-screen"></div><div class="ui-popup-container ui-selectmenu-hidden"><div class="ui-selectmenu ui-popup ui-body-a ui-overlay-shadow ui-corner-all" aria-disabled="false" data-disabled="false" data-theme="a" data-shadow="true" data-corners="true" data-transition="none" data-position-to="origin"><div class="ui-header ui-bar-b"><h1 class="ui-title">Custom menu example</h1></div><ul class="ui-selectmenu-list ui-listview" id="select-choice-a-menu" role="listbox" aria-labelledby="select-choice-a-button" data-theme="b"><li data-option-index="0" data-icon="false" data-placeholder="true" class="ui-selectmenu-placeholder ui-btn ui-btn-up-b ui-btn-icon-right ui-li" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Custom menu example</a></div></div></li><li data-option-index="1" data-icon="false" class="ui-btn ui-btn-up-b ui-btn-icon-right ui-li" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Standard: 7 day</a></div></div></li><li data-option-index="2" data-icon="false" class="ui-btn ui-btn-up-b ui-btn-icon-right ui-li" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Rush: 3 days</a></div></div></li><li data-option-index="3" data-icon="false" class="ui-btn ui-btn-up-b ui-btn-icon-right ui-li" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Express: next day</a></div></div></li><li data-option-index="4" data-icon="false" class="ui-btn ui-btn-up-b ui-btn-icon-right ui-li ui-li-last" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Overnight</a></div></div></li></ul></div></div><div class="ui-popup-screen ui-screen-hidden"></div><div class="ui-popup-container ui-selectmenu-hidden"><div class="ui-selectmenu ui-popup ui-body-a ui-overlay-shadow ui-corner-all" aria-disabled="false" data-disabled="false" data-theme="a" data-shadow="true" data-corners="true" data-transition="none" data-position-to="origin"><div class="ui-header ui-bar-b"><h1 class="ui-title">Custom menu example</h1></div><ul class="ui-selectmenu-list ui-listview" id="select-choice-a-menu" role="listbox" aria-labelledby="select-choice-a-button" data-theme="b"><li data-option-index="0" data-icon="false" data-placeholder="true" class="ui-selectmenu-placeholder ui-btn ui-btn-up-b ui-btn-icon-right ui-li" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Custom menu example</a></div></div></li><li data-option-index="1" data-icon="false" class="ui-btn ui-btn-icon-right ui-li ui-btn-up-b" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Standard: 7 day</a></div></div></li><li data-option-index="2" data-icon="false" class="ui-btn ui-btn-icon-right ui-li ui-btn-up-b" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Rush: 3 days</a></div></div></li><li data-option-index="3" data-icon="false" class="ui-btn ui-btn-icon-right ui-li ui-btn-hover-b ui-focus ui-btn-up-b" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="0" class="ui-link-inherit">Express: next day</a></div></div></li><li data-option-index="4" data-icon="false" class="ui-btn ui-btn-up-b ui-btn-icon-right ui-li ui-li-last" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Overnight</a></div></div></li></ul></div></div><div class="ui-screen-hidden ui-popup-screen"></div><div class="ui-popup-container ui-selectmenu-hidden"><div class="ui-selectmenu ui-popup ui-body-a ui-overlay-shadow ui-corner-all" aria-disabled="false" data-disabled="false" data-theme="a" data-shadow="true" data-corners="true" data-transition="none" data-position-to="origin"><div class="ui-header ui-bar-b"><h1 class="ui-title">Custom menu example</h1></div><ul class="ui-selectmenu-list ui-listview" id="select-choice-a-menu" role="listbox" aria-labelledby="select-choice-a-button" data-theme="b"><li data-option-index="0" data-icon="false" data-placeholder="true" class="ui-selectmenu-placeholder ui-btn ui-btn-up-b ui-btn-icon-right ui-li" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Custom menu example</a></div></div></li><li data-option-index="1" data-icon="false" class="ui-btn ui-btn-up-b ui-btn-icon-right ui-li" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Standard: 7 day</a></div></div></li><li data-option-index="2" data-icon="false" class="ui-btn ui-btn-up-b ui-btn-icon-right ui-li" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Rush: 3 days</a></div></div></li><li data-option-index="3" data-icon="false" class="ui-btn ui-btn-up-b ui-btn-icon-right ui-li" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Express: next day</a></div></div></li><li data-option-index="4" data-icon="false" class="ui-btn ui-btn-up-b ui-btn-icon-right ui-li ui-li-last" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Overnight</a></div></div></li></ul></div></div><div class="ui-screen-hidden ui-popup-screen"></div><div class="ui-popup-container ui-selectmenu-hidden"><div class="ui-selectmenu ui-popup ui-body-a ui-overlay-shadow ui-corner-all" aria-disabled="false" data-disabled="false" data-theme="a" data-shadow="true" data-corners="true" data-transition="none" data-position-to="origin"><div class="ui-header ui-bar-b"><h1 class="ui-title">Custom menu example</h1></div><ul class="ui-selectmenu-list ui-listview" id="select-choice-a-menu" role="listbox" aria-labelledby="select-choice-a-button" data-theme="b"><li data-option-index="0" data-icon="false" data-placeholder="true" class="ui-selectmenu-placeholder ui-btn ui-btn-up-b ui-btn-icon-right ui-li" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Custom menu example</a></div></div></li><li data-option-index="1" data-icon="false" class="ui-btn ui-btn-up-b ui-btn-icon-right ui-li" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Standard: 7 day</a></div></div></li><li data-option-index="2" data-icon="false" class="ui-btn ui-btn-up-b ui-btn-icon-right ui-li" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Rush: 3 days</a></div></div></li><li data-option-index="3" data-icon="false" class="ui-btn ui-btn-up-b ui-btn-icon-right ui-li" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Express: next day</a></div></div></li><li data-option-index="4" data-icon="false" class="ui-btn ui-btn-up-b ui-btn-icon-right ui-li ui-li-last" role="option" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-iconpos="right" data-theme="b" aria-selected="false"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="#" tabindex="-1" class="ui-link-inherit">Overnight</a></div></div></li></ul></div></div></div>


<div class="ui-loader ui-corner-all ui-body-a ui-loader-default"><span class="ui-icon ui-icon-loading"></span><h1>loading</h1></div></body></html>