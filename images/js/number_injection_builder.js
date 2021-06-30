/**
 * @file
 * @brief JS implementation of the phone number injection builder for Chrome browser.
 */

// create namespace
if (!window.SkypeClick2Call)
{
	window.SkypeClick2Call = {};
}

if (!SkypeClick2Call.NumberInjectionBuilder)
{
	SkypeClick2Call.NumberInjectionBuilder = {globalNamespace:SkypeClick2Call};

/*	initialized in C++ part
	SkypeClick2Call.NumberInjectionBuilder.HIGHLIGHTING_MARK_BEGIN      = " begin_of_the_skype_highlighting";
	SkypeClick2Call.NumberInjectionBuilder.HIGHLIGHTING_MARK_END        = "end_of_the_skype_highlighting";

	SkypeClick2Call.NumberInjectionBuilder.CSS_NUMBER_HIGHLIGHTING_MARK = "skype_pnh_mark";
	SkypeClick2Call.NumberInjectionBuilder.CSS_NUMBER_PRINT_CONTAINER   = "skype_pnh_print_container";
	SkypeClick2Call.NumberInjectionBuilder.CSS_NUMBER_CONTAINER         = "skype_pnh_container";
	SkypeClick2Call.NumberInjectionBuilder.CSS_NUMBER_LEFT_SPAN         = "skype_pnh_left_span";
	SkypeClick2Call.NumberInjectionBuilder.CSS_NUMBER_DROPART_SPAN      = "skype_pnh_dropart_span";
	SkypeClick2Call.NumberInjectionBuilder.CSS_NUMBER_DROPART_WOA_SPAN  = "skype_pnh_dropart_wo_arrow_span";
	SkypeClick2Call.NumberInjectionBuilder.CSS_NUMBER_DROPART_FLAG_SPAN = "skype_pnh_dropart_flag_span";
	SkypeClick2Call.NumberInjectionBuilder.CSS_NUMBER_TEXTAREA_SPAN     = "skype_pnh_textarea_span";
	SkypeClick2Call.NumberInjectionBuilder.CSS_NUMBER_TEXT_SPAN         = "skype_pnh_text_span";
	SkypeClick2Call.NumberInjectionBuilder.CSS_NUMBER_RIGHT_SPAN        = "skype_pnh_right_span";
*/
}

SkypeClick2Call.NumberInjectionBuilder.CreateInjectionElements = function (injectionRange,
                                                                        isFaxOnly,
                                                                        freeNumberText, // flagOffset,
                                                                        skypeLogoImg,   // dropartTitle,
                                                                        highlightingClassName,
                                                                        // highlightingTitle, - removed by TBAR-3014
                                                                        numberInText,
                                                                        changeSink)
{
	var result = {};

	try
	{
		// ChangeSinkGuard
		changeSink.BeginInjection()

	    // 1) wrap phone number to make it invisible on screen
	    var printWrapperElement = document.createElement("SPAN").cloneNode(true);
	    printWrapperElement.className = this.CSS_NUMBER_PRINT_CONTAINER;

	    // try to use common 
	    try
	    {
	        injectionRange.surroundContents(printWrapperElement);
	    }
	    catch(e)
	    {
	        printWrapperElement.appendChild(injectionRange.extractContents());
	        injectionRange.insertNode(printWrapperElement);
	        injectionRange.selectNode(printWrapperElement);
	    }

	    // save created element
	    result.printWrapperElement = printWrapperElement;

	    // 2) create container element
	    var highlightContainerElement = document.createElement("SPAN");
	    highlightContainerElement.className = this.CSS_NUMBER_CONTAINER;
	    highlightContainerElement.dir = "ltr";
	    highlightContainerElement.tabIndex = "-1";
	    if (!isFaxOnly)
	    {
                  highlightContainerElement.setAttribute("onmouseover",
                                               "SkypeClick2Call.MenuInjectionHandler.showMenu(this, event)");
                  highlightContainerElement.setAttribute("onmouseout",
                                               "SkypeClick2Call.MenuInjectionHandler.hideMenu(event)");
	    }

	    // save created element
	    result.containerElement = highlightContainerElement;


	    // 2.1) begin mark
	    var begin_mark_span = document.createElement("SPAN");
	    begin_mark_span.className = this.CSS_NUMBER_HIGHLIGHTING_MARK;
	    begin_mark_span.appendChild(document.createTextNode(this.HIGHLIGHTING_MARK_BEGIN));
	    highlightContainerElement.appendChild(begin_mark_span);

	    // keeps left part of highlighted number visible
	    highlightContainerElement.appendChild(document.createTextNode("\u00A0"));

	    // 2.2) highlighting style area
	    var highlightStyleElement = document.createElement("SPAN");
	    highlightStyleElement.className = highlightingClassName;
	    highlightStyleElement.dir = "ltr";
	    highlightStyleElement.setAttribute("skypeaction", "skype_dropdown");
        // highlightStyleElement.title = highlightingTitle; removed by TBAR-3014

	    // save created element
	    result.styleElement = highlightStyleElement;

        /* removed commented out 2.2.1 and 2.2.2and 2.2.2.1 and 2.2.2.2 and 2.2.3 */

	    // 2.2.4) create text part
	    var highlightTextAreaElement = document.createElement("SPAN");
	    highlightTextAreaElement.className = this.CSS_NUMBER_TEXTAREA_SPAN;

        // create Skype logo
        var skype_logo_img = document.createElement("IMG");
        skype_logo_img.className = this.CSS_NUMBER_LOGO_IMG;
        skype_logo_img.setAttribute("src", skypeLogoImg);
        highlightTextAreaElement.appendChild(skype_logo_img);

        // create number 
	    var text_span = document.createElement("SPAN");
	    text_span.className = this.CSS_NUMBER_TEXT_SPAN;
	    text_span.appendChild(document.createTextNode(numberInText));
	    highlightTextAreaElement.appendChild(text_span);

	    // create free number 
	    var free_text_span = document.createElement("SPAN");
	    free_text_span.className = this.CSS_NUMBER_FREE_TEXT_SPAN;
	    free_text_span.appendChild(document.createTextNode(" " + freeNumberText + " "));
	    highlightTextAreaElement.appendChild(free_text_span);

	    highlightStyleElement.appendChild(highlightTextAreaElement);

	    // save created element
	    result.textAreaElement = highlightTextAreaElement;

        /* 2.2.5) create right part
	    var highlightRightElement = document.createElement("SPAN");
	    highlightRightElement.className = this.CSS_NUMBER_RIGHT_SPAN;
	    highlightRightElement.appendChild(document.createTextNode("\u00A0\u00A0\u00A0\u00A0\u00A0"));
	    highlightStyleElement.appendChild(highlightRightElement);
        */

	    // 2.3) append highlighting style area to the container element
	    highlightContainerElement.appendChild(highlightStyleElement);

        /* keeps left part of highlighted number visible
	    highlightContainerElement.appendChild(document.createTextNode("\u00A0"));
        */

	    // 2.4) end mark
	    var end_mark_span = document.createElement("SPAN");
	    end_mark_span.className = this.CSS_NUMBER_HIGHLIGHTING_MARK;
	    end_mark_span.appendChild(document.createTextNode(this.HIGHLIGHTING_MARK_END));
	    highlightContainerElement.appendChild(end_mark_span);

	    // 3) append container to the DOM after 'print wrapper'
	    printWrapperElement.parentNode.insertBefore(highlightContainerElement, printWrapperElement.nextSibling);
	}
	catch(e)
	{
		console.log(e);
	}
	finally
	{
		// ChangeSinkGuard
		changeSink.EndInjection()
	}

	return result;
}

SkypeClick2Call.NumberInjectionBuilder.RemoveElement = function(deep, node, range)
{
	try
	{
		if (!node)
		{
			return;
		}

		var parentNode = node.parentNode;
	
		if (!deep)
		{
			var tmpNode = null;
			while (node.firstChild) //while we can get firstChild property
			{
				tmpNode = parentNode.insertBefore(node.firstChild, node);
			}
			if (tmpNode && range)
			{
				range.setStartBefore(tmpNode);
			}
		}

		parentNode.removeChild(node); //remove element
	}
	catch(e)
	{
		console.log(e);
	}
}

SkypeClick2Call.NumberInjectionBuilder.DestroyInjectionElements = function(textRange,
                                                                         printWrapperElement,
                                                                         containerElement,
                                                                         textAreaElement,
                                                                         changeSink)
{
	try
	{
		// ChangeSinkGuard
		changeSink.BeginInjection()

		// 1) remove print wrapper element
		this.globalNamespace.NumberInjectionBuilder.RemoveElement(false, printWrapperElement, textRange);

		// 2) remove highlighting
		if (containerElement)
		{
			this.globalNamespace.NumberInjectionBuilder.RemoveElement(true, containerElement, null);
		}
		else
		{
			this.globalNamespace.NumberInjectionBuilder.RemoveElement(true, flagElement, null);
			this.globalNamespace.NumberInjectionBuilder.RemoveElement(true, dropartElement, null);
			this.globalNamespace.NumberInjectionBuilder.RemoveElement(true, textAreaElement, null);
		}
	}
	catch(e)
	{
		console.log(e);
	}
	finally
	{
		// ChangeSinkGuard
		changeSink.EndInjection()
	}
}


// create META to inform contentscript.js that this file is ready
document.head.appendChild(document.createElement('meta')).name = "number_injection_builder.js";
