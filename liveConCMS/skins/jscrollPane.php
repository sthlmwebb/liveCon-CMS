/*
 * CSS Styles that are needed by jScrollPane for it to operate correctly.
 *
 * Include this stylesheet in your site or copy and paste the styles below into your stylesheet - jScrollPane
 * may not operate correctly without them.
 */

.jspContainer
{
	overflow: hidden;
	position: relative;
}

.jspPane
{
	position: absolute;
}

.jspVerticalBar
{
	position: absolute;
	top: 0;
	right: 0;
	width: 20px;
	height: 100%;
	background:#edeeee;
	border-radius: 5px;
	-moz-border-radius: 5px;
}

.jspHorizontalBar
{
	position: absolute;
	bottom: 0;
	left: 0;
	width: 100%;
	height: 16px;
	background: red;
}

.jspVerticalBar *,
.jspHorizontalBar *
{
	margin: 0;
	padding: 0;
}

.jspCap
{
	display: none;
}

.jspHorizontalBar .jspCap
{
	float: left;
}

.jspTrack
{
	background: #edeeee;
	position: relative;
	border-left:1px solid #c4c4c4;
	border-right:1px solid #c4c4c4;

}

.jspDrag
{
	background: #c1c1c1;
	position: relative;
	top: 0;
	left: 0;
	cursor: pointer;
	width:12px;
	margin-left:3px;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;	
	background-image:url('images/scroller_verticalBar.png');
	background-repeat:no-repeat;
	background-position:center center;
}

.jspHorizontalBar .jspTrack,
.jspHorizontalBar .jspDrag
{
	float: left;
	height: 100%;
}

.jspArrow
{
	border-left:1px solid #c4c4c4;
	border-right:1px solid #c4c4c4;
	text-indent: -20000px;
	display: block;
	cursor: pointer;
}

.jspArrow.jspDisabled
{
	cursor: default;
}

.jspVerticalBar .jspArrow
{
	height: 20px;	
}

.jspArrowUp {
	border-top:1px solid #c4c4c4;
	border-radius: 5px 5px 0 0;
	-moz-border-radius: 5px 5px 0 0;
	-webkit-border-radius: 5px 5px 0 0;
	background-image:url('images/scrollbar_arrowUp.png');
	background-repeat:no-repeat;
	background-position:center center;
}

.jspArrowDown {
	border-bottom:1px solid #c4c4c4;
	border-radius:0 0 5px 5px;
	-moz-border-radius:0 0 5px 5px;
	-webkit-border-radius:0 0 5px 5px;
	background-image:url('images/scrollbar_arrowDown.png');
	background-repeat:no-repeat;
	background-position:center center;
}



.jspHorizontalBar .jspArrow
{
	width: 16px;
	float: left;
	height: 100%;
}

.jspVerticalBar .jspArrow:focus
{
	outline: none;
}

.jspCorner
{
	background: #eeeef4;
	float: left;
	height: 100%;
}

/* Yuk! CSS Hack for IE6 3 pixel bug :( */
* html .jspCorner
{
	margin: 0 -3px 0 0;
}