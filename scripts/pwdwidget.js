/* 
*
* Password Widget 1.0
*
* This script is distributed under the GNU Lesser General Public License.
* Read the entire license text here: http://www.gnu.org/licenses/lgpl.html
*
* Copyright (C) 2009 HTML Form Guide 
* http://www.html-form-guide.com/
*/

function PasswordWidget(divid,pwdname)
{
	this.maindivobj = document.getElementById(divid);
	this.pwdobjname = pwdname;

	this.MakePWDWidget=_MakePWDWidget;
}

function _MakePWDWidget()
{
	var code="";
    var pwdname = this.pwdobjname;

	this.pwdfieldid = pwdname+"_id";

	code += "<input type='password' class='pwdfield' name='"+pwdname+"' id='"+this.pwdfieldid+"'>";

	this.pwdtxtfield=pwdname+"_text";

	this.pwdtxtfieldid = this.pwdtxtfield+"_id";
	code += "</div>";
	this.maindivobj.innerHTML = code;

}










