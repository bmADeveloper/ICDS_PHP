/*.................................Empty field validation...............................*/
/*.................................onsubmit="valid_empty();"...........................*/
function valid_empty()
{
	     var name= fm.name.value; 
         if(name.length==0)
		 {
			  alert("must be enter your name !!!");
		      fm.name.select();
		 }
		 
		  
}

/*................................Name Validation.....................................*/
/*...............................onchange="valid_name()".............................*/

function valid_name(name)
{
	   var name=fm.name.value;
	   if(/^[A-Za-z.\s]+$/.test(name))
	   {
	      return(true);
	   }
	   else
	   {
		   alert("allow only [. space letters] !!!"); 
		   fm.name.select();
		   return (false);
	   }	   
   }



/*.................................Email Validation.......................................*/
/*............................onchange="valid_email()".................................................*/
function valid_email(email)
{ 
    var email=fm.email.value;
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
    {
     return (true);
	}
  else
  {
    alert("You have entered an invalid email address!");
	fm.email.select();
    return (false);
  }
}


   
 /*............................UserName validation With Length(5 to 20)......................................*/
 /*............................onchange="valid_user_name()".................................................*/
 
 function valid_user_name(username)
   {
	   var user_name=fm.username.value;
	   if(/^[A-Za-z0-9\s]+$/.test(user_name) && (user_name.length >= 5 || user_name.length >= 20))
	   {
	     return(true);
	   }
	   else
	   {
		    alert("User_Name allow only [ numeric and letters] And length should be 5 !!!");
		    fm.username.focus();
		    fm.username.select();
			return(false);
	   }
   }
   
   
 /*........................... .Phone Number.........................................*/
  /*............................onchange="valid_phone_number()"..........................*/
 
 function valid_phone_number(phone_number)
   {
	      var phone_number=fm.phone_number.value;
	      if(/^\d{10}$/.test(phone_number))
		  {
	         return(true);
		   }
		   else
		   {
		     alert("you should give 10 digit mobile numbers !!!"); 
			 document.fm.phone_number.focus();
			 document.fm.phone_number.select();
			 return(false);
		   }
	   
   }
   
/*..................................Address with Length (12 to 60)............................................*/
/*.....................................onchange="valid_address()"..........................*/

   
  function valid_address(address)
   {
	      var address=fm.address.value;
	      if(/^[a-zA-Z0-9\s\,\''\-]*$/.test(address) && (address.length >= 12 || address.length >= 60))
		  {
	         return(true);
		   }
		   else
		   {
		      alert("You should Valid address and Minimum 12 char.. !!!"); 
			  fm.address.focus();
			  fm.address.select();
			  return(false);
		   }
	   
   } 
 /*..................................Date Of Birth............................................*/  
 /*.....................................onchange="valid_dob()"..........................*/
   
function valid_dob(dob)
{
	 var dobexp=/^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/g;
	 var dob=fm.dob.value;
	 if(dobexp.test(dob))
     {
	   return(true);
     }
	 else
	{
        alert("Invali Format(dd/mm/yyyy) !!!"); 
	    fm.dob.focus();
	    fm.dob.select();
		return(false);		     
	 }
	   
 }  
 
 /*..............................................Password Validation........................................*/
   
                       /*- -----Matching Password---- ---------- */
              /*----- -----------onchange="valid_password_match()"------- -------*/
function valid_password_match()
{
	   var password= fm.password.value;
	   var confirm_password= fm.confirm_password.value;
	   if(!(password == confirm_password))
	   {
	      alert("Does not match password !!!");
		   fm.password.focus();
		  fm.password.select();
		  return(false);
	   }
	   return(true);
}
/*--------------------------------validation for Password Strings------------------------------------------ */
/*------------------------------onchange="valid_password_string()"------------------------------------------*/
function valid_password_string()
{
          var password_string=fm.password.value;
	      var password_length=password_string.length;	   
          if( /[0-9]/.test(password_string) && /[a-z]/.test(password_string) && /[A-Z]/.test(password_string) && /[!@#$%^&*()]/.test(password_string) && (password_length > 7 && password_length < 31))
	      { 
			 return(true);
		  }
			else
			{
				alert("Atleast one lowercase/uppercase/special and Length must be between 8 and 30 (ex:AAAbbb12@)");
				fm.password.focus();
				fm.password.select();
				return(false);
			}
}
   

/*--------------------------------validation for Copy Past Disable------------------------------------------ */
/*------------onKeyDown="return valid_copy_past(event)" onMouseDown =" return valid_copy_past(event)"--------*/
	
   function valid_copy_past(e)
	{
		var c = event.keyCode || e.charCode || e.button;
		if (c  == 17 || c == 2)
		{
			alert("copy paste disabled");
			return false;
		}
		
	}   
   
/*................................................................END.................................................*/   
   