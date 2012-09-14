a p {width:100%;} /*Fixes width of the p#editme not being 100%*/


/* lc-dialog Styles */

#lc-dialog {
	font-family:"Trebuchet MS", Helvetica, sans-serif;
	font-size:13px;
	line-height:13px;
}

#lc-dialog fieldset {
	display:block;
	margin-bottom:12px;
}

#lc-dialog fieldset input[type="text"], #lc-dialog fieldset input[type="file"] {
	display:block;
	line-height:16px;
}

#lc-dialog fieldset input[type="text"] + em, #lc-dialog fieldset input[type="file"] + em {
	font-style:italic;
	display:block;
	margin-top:3px;
}

/*The "Edit text" button on the pages*/
.lc-editable-object {cursor:pointer}

/*Tiny MCE in the popup*/
#lc-dialog #TextArea1_tbl {width:100%}

/*Style the buttons in the MCE popup*/
.lc-button {
	padding:5px;
	margin:0 10px 0 0;
	cursor:pointer
}

/* Change image hover */
#lccms-hoverOverlay {
	background-image:url('jquery-ui/images/ui-bg_diagonals-thick_20_666666_40x40.png');
}

#lccms-hover-content {color:white; text-shadow:1px 1px 0 #000;}


/* Edit and undo buttons */
#lc-button-editpage,
#lc-button-undoedit,
.editpage_changepic {
  display:inline-block;
  width:auto;
  background-repeat:no-repeat;
  background-position:6px center;
  padding:3px 3px 3px 28px;
  margin:5px 5px 5px 0;
  font-size:9px;
  text-align:center;
  border-style:solid;
  border-width:1px;
  -moz-border-radius:5px;  
  -webkit-border-radius:5px;
  cursor:pointer;
}

#lc-button-editpage {
  background-image:url('images/icon_editpage.png');
  background-color:#feffcc;
  border-color:#e9c621;
}

#lc-button-undoedit {
  background-image:url('images/icon_undo.png');
  background-color:#ffd8cc;
  border-color:#e92921;
}

#lc-button-editpage a,
#lc-button-undoedit a {
	color:black;
	font-weight:bold;
	font-size:12px;
}


/* Editme 1 Editme 2 */

.editme1 em span b, .editme2 em span b {color:inherit}
.editme1 em span, .editme2 em span {color:inherit}
.editme1 em, .editme2 em {color:inherit}

h1.editme1, h1.editme2 {
  color:inherit;
  font-weight:inherit;
  font-family:inherit;
  font-size:100%;}


#slogan-name input {
  font-weight:inherit;
  font-family:inherit;
  font-size:100%;
  display:inline-block;
}

#slogan-name .inplace_form {display:inline-block; float:left; width:auto; vertical-align:middle;}

#slogan-name .inplace_field {
	width:80%; 
	display:inline-block;
	float:left;
}

.inplace_save,
.inplace_cancel {
  background-color:transparent;
  background-position:0 0;
  background-repeat:no-repeat;
  width:16px;
  height:16px;
  padding:0;
  margin: 0 0 0 5px;
  border-style:none;
  z-index:9000;
	display:inline-block;
	float:right;
	vertical-align:middle;
}

.inplace_save:hover,
.inplace_cancel:hover {
  cursor:pointer;
} 

.inplace_save {
  background-color:transparent;
  background-image:url('images/inplace_icon_accept.png')
}

.inplace_cancel {
  background-color:transparent;
  background-image:url('images/inplace_icon_cancel.png')
}

