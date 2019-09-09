<?php

echo $forgot_tpl='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body style="padding:0px; margin:0px;">
  <table width="500px" style="margin:auto; background:#f9f9f9" cellpadding="0" cellspacing="0;"> 
  <!---header start-->
  <thead>
   <tr>
	<td style="height:10px;"></td>
    </tr>
     <tr>
	   <td valign="top">
	     <table cellpadding="0" cellspacing="0" >
	     	      <tr>
	       <td style="padding:0px 0px 0px 10px;"><font style="font-size:25px; text-align:center; color:#2d2d2d;font-family:Arial,sans-serif; text-transform:uppercase; padding-top:15px;">Creamat</font></td>
	      </tr>
      		 </table>
		  </td>
	 </tr>
	 </thead>
	 
 <tbody>
   <tr>
   <td style="height:10px;"></td>
	</tr>
    <tr>
	 <td>
	 <table style="width:500px; margin:auto; padding:10px; border-bottom:1px solid #efefef">
			  <tr>
			    <td style="padding:10px; background:#000;"><font style="font-size:16px;color:#fff;font-size:16px;font-family:Arial,sans-serif;">Reset your Creamat account password</font></td>
			  </tr>
			  <!--header-end-->
			  
			  <!--desc start-->
			  <tr>
			    <td style="font-size:16px; color:#2d2d2d;font-family:Arial,sans-serif;">
				<p style="padding-bottom:0px;margin-top:10px; margin-bottom:0px; padding-top:0px;font-family:Arial,sans-serif; font-size:14px;">Dear '.$final_data['jsondata']['userdata']['name'].',</p></td>
			  </tr>
			  <tr>
			   <td>
			    <p style="padding-bottom:0px;padding-top:0px;font-size:14px;margin-top:10px; margin-bottom:0px; text-align:justify; line-height:20px;font-family:Arial,sans-serif;">We Received  a request to reset the password for your account. If you made this request, please click the following button.</p>
			   </td>
			  </tr>
			  
			  
			   <tr>
			    <td style="height:25px;"></td>
			   </tr>
			  
			  <tr>
			   <td><a href="'.$link.'" style="background:#000; color:#fff; border-radius:3px;padding:10px;font-family:Arial,sans-serif;font-size:14px; text-decoration:none; border:1px solid #000;">Reset your password</a></td>
			  </tr>
			  <tr>
			    <td style="height:25px;"></td>
			   </tr>
			  
		

		
			  <tr>
			    <td style="border-top:1px solid #efefef; margin-top:20px;"></td>
			  </tr>
			 
					<!--desc end-->
			
			<!--footer start-->
			<tr>
			   <td style="height:20px;"></td>
			  </tr>
			  
			  
			  <tr>
			    <td style="font-size:14px; color:#2d2d2d;font-family:Arial,sans-serif; padding-top:10px;">Your Sincerely</td>
			  </tr>
			  <tr>
			    <td style="font-size:14px; color:#000;font-weight:bold; padding-bottom:10px;font-family:Arial,sans-serif; ">Team Creamat</td>
			  </tr>
			  <tr>
			 <td>
			  <table style="width:500px; margin:auto;padding:10px 0px 10px 0px; border-top:3px solid #000" cellpadding="0" cellspacing="0" >
				  
	      <tr>
		 <td style="font-size:13px; color:#2d2d2d;font-family:Arial,sans-serif;">&copy; copyrights 2016. All Rights Reserved</td>
		 	 <td><a href="#"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAq1JREFUeNrsV71rFEEU/83O7N7mZMEgiB/IWZmEBAujgo2KVjZptFcCChYW/gNWQgobK7VRECzsDBZqK1aCRlMYTTBoYi5G5cIl533s7s2Mbzbhvj28r9jkDXews3Pzm/d7v/fmHrs/+XrpztMPHmMCFkNPTWn60kVcHRvOsKPjD34zi++wmIWtMKUVlJJZAXDZW1BDoy49GSx6koJ1kd5CUAQ5FGFpGhYNhRCu40BwQZ6qjaPQe9ENQEnBy+d9DCT6MbTfw+hgApoEk1nL4etKCq9mfmE9H5K3ZS9FpyT6oULcYbh+6TgunB6CY9t16y7efIHU3DfE3HiJ9o6Ai+SpLThuXTuDEyN7mwhKbx6zbB2pyg9CXBkbbAq6EdN6IYlOBXvqSKLWPwSBwnwyjUzOjxjJ5QJKHtYdYBZRzUjJ1fNBqHF54jk+LqfAaUQLJYMjnKq0ahvYbCEsVCnV2PTsMmYW0/SelwJpKiID6x7VrHSEsq1lfJqnDLZUw9i2DRwViU2svF/cVGwlExoFmkcFcMzhdcyI1qhlGD64G5xrMK7gZzXitlO1bqfn4vBAf1QaLaYhtYWFlfXoMG0VEEU567o2Ht44Fx3gb3Zs5AAe0afSxiee4c2nn4jHRPt5bKhuudAUa8tHG8Ct3inTc0l8odRybN4ZcMxpTY+ff+TwfbVQF55/3sX8zg8l7j55D48uAhPzPFWo82cPYc+uvtK62cUUXr5LQkjAoZi+nTextdtPJ5MaoVS4NzkFRko1As3SVXdydF8V8MLSKm4/nopUb4qGoCoTd0VNtreYx4Ysry9WZoECxWtrMLfgxe2qPG7IIP6TbQNvA/cOWOutBzWY5LHkSqvub96khTGYghqoNDVtUlOyt9q0mUu/4a1BLpk/CKxh0yajpu2PAAMA3a31JoMpScsAAAAASUVORK5CYII=" /></a>
			 <a href="#" style="margin-left:10px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABUZJREFUeNrkV2tsFFUUPvcxs7vdbvfRtGxLoTRCX6AENEVTfPwQajRENCbID0QFkSgJ0RD5AUJMTDRCqhGNhqAJoEYMESk/SPhRCL4qSBpEeaSsjXTZFtjubvc1szsz93pmqbRFCq2h4Yc3OcnO3Dn3O+c7j3uWSCnhTiwKd2jxz0I5mOIi0OhjEM1JOBgxIWrIwrs+XQIlBCxkZTbuPxBgBSWbI4JiCICOmAXH45b396S1KpSxnozkRB3u0XKVnm8sYQea/PzTqU4S/TUpoMYJkBLEdVETDbyEE97WZ67UgWx3EBCM3NhCMkjP8MC40I6ujHj4q3BueywnagsfDepHdKspkjWbOhPm8hXVjhWaBVd+iFmPdcTMl9fVOt/hMUPWfRzSPzkctWatvcuxxsluAIqH5dG7jAWgILoYBD05IBpau7T9WVN6/xU02wD0oj8npreG9HY8Qxg5oTwUVL+Y5WE7eXu/Odf+7vSA8eqXPcSzsIyvdVCSuD4RNEvC91ETJmMIbGCGJ288o7VmDeGF0WgaVDaFtN1hM3xK+7wA/+btc/oHNKoL/z8fHL2cf+6j7tyR3py8vwgPG3Ee/j6TlhAzJWiIfCZjNZwaMBfeFHSYrs3aBc26b8tZrW2Wlw7QWg8LX/sA7erTrNm7e/Qj3/Ua72Jcgs5BAzhuR/MSwlkJlzWAzpiYK8TYq8LODUtI18IKxxtvNTo30yYfO65wkruWNXgUZrHjYF9+/Y4Luc5Dl/OtSRNqFEpAxb1yhUAqh8mjgQPIOOoHQ7W4Qt22qlrdckWTwKe7Wc+DpXxfe2/+WeBkRGxShgj+GBWvnUiYK+uK2U+ckqMllHX6VdpTrEjnuAoXHUP2YsV4bheWFk9ZQJZVqau7M9bs7oxogOviaotuSc/JhNGCDy0n4gZQSkzUz4/LY1ylKjGmuSmkME84ZtjzPg519/qVHb16fpMusDRuVMRkCEVIycXVsI+jRxJAvIu/JS10BJVri0l6Z0hfb9NMaKFSJmaRQnKGOuIWGoAezw/w9r0RFs8Ywo/PE9O7Mb5elfYvKOPn3MzOMwL0nhLWv6RSfc/OuglbQkK9hx1r9LJ4sIjBZIwzLXMS2FDv2PJIhfq1HQSQE8PzPB/bk8Q+EM8JSKDwJIJhaVprahxLPZQePhY3VvcbYia+Vm8XzUE3O4tlu6crLa75xfeFjULgMb7lmK10ZglvO5UyA1d0UT3echmtcTxTqbw/x8/0tDlEJ28uZYPXHUnvDudf7x4wZ9gU3BZQrJHqEn520SRll4klpA47lFZioCehVJfQ7MZ61zK3StO3raiQxhemqm9WuYlepAB41CGhvdj0SYFrgCeC/JcN9c6nPJyEC+AS/nuyIa2PVjh2obd7B3CyMZFyY5iwllc2QCQrAFtnIaldhPzpV9gezkgWuylTGCF4F3vHG9cGH+/Y2li0tJhDnqJjChkp3L4X7N55OiXgQJ8FNQ4KLg6RpZPVTX9pYs7+XuNDHGumjDnmyFRlET+6vMqxxMtlKpkf0W2HksthTwjYTYptK/AF9mpAwLt/jpsvHU+YL2YN6R5TP5NXQZvLlC9aSpVVqKLZ4xIdxWB+LGEtRirZJUP4/kiajTg/NYWyVpMUUi2YSscAiFLESXxRlbq5OcC3adgozFvkBg9rEDgUNdZdyuKVaA/3g0PaqKZeD6iQ/mkutvfxoLJ1hpudT5viave9hTpvDrDP67zOXefTYsHJhPl0jy7mR/Oi/GZKOI0YQZWeqi1mbSjfZk24WKaSwkA41iIg/7u/MHcM+G8BBgA0o2D4TgQ3QgAAAABJRU5ErkJggg==" /></a>
			 <a href="#" style="margin-left:10px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA2BJREFUeNrkVktoE1EUPe/NJLZpSW3Fqm38tFBaP1WxftCCCm66UES0FQoqdFV04UIRVBBdWXHhqoI7f6DoStyISIViXWgrblRI/cRaP622xjaNSSYzz/smmTSTNFpxogsvzDAz784993fue0wIgX8hqrxtONd9zD8Sbit0KaX5cIPRpRki5lF5d/sa38EjTXWfmIyYHbr9d8I2BBoqSzp6D286qlouccZS6zL7wjDoOwPnzDlcuoKReI185lmL5JXQDfhmFmKWxw0jpjsaNMVhpGo8GakA1QHnd9Zjx/IKTETjOHXXjws9b8BdirMO2ICjOtrWLcS+tQvgLVAxr6QAneTE4govjLiRP2ApS+cU294Vyk1VqQfQ8wlMILeeDdk+BUbDePwuCDicaluNuVvBnedD2H25F3tXz8fXsIaOrpf4PB4FV/kvjYk03v4WcCK3DDceBHCjJ5CwRIC8yG1aMzRKt6YnLMs1ygKjdUFNaGUMJhVF4r+fOGvval1gYZkHzZurTS4zk3caLve9h0bG11XNwsbqMrP7GXG8JzCKh/0jaGnwYXv9XMzzFmCC6NdHpbnSO4hXwyEzi9MANlBXXoSz25amvg1Tmq8//YgYGWyqnY2TTbWptc4Hb7BnlQ/tjYtsRrcumYP9jVXYdfExuvu/TAmelYu4YZ+e4xSpSBYumkGp1lWVWaCWzC5240LzCniIllNtRPxPOrOUJpuU998i6Ke0ZkodUXMDlUdohrPAUjru9WPZ6S7Un7mP1qtPEMvg+8pKr7k5OAocGAnjBI1U2YBRer/2aACP3gZtOuXFM6Y3uX5HXlB6tVgcjGjFk1R6TQMnXQpzUOqPgCNxfXJqJEXPaCTG4Dwwm+Y3x4Ed3Z3+P2Ce0Q0z0rpSzTh/uZRsv12KXUfNcWZTM1swRPTwp02hgeB3c8OQa8OhGPyfQ4lOJntvv4btbUvPg8GITefDWGTK1k4cbw/fFlak0kGV2yOxppFCOjKCpE0aSEKel7MilHqWjqSXNf/lQbKmzHPTf3xLS9Z+TDsj4ppu44fllDSgpY9Ell0a00mBnDrkCJ9MtfQoWRt5ZznqIv9njP3i+Mpyk5lwilzKQAq4oaLkUt+HsW1cYXnrYnkqKS92vzywfkFnqsb/Qn4IMAAABUitwrSZPwAAAABJRU5ErkJggg==" /></a>
			 </td>
		 
	      </tr>
       		 </table>
			 </td>
			</tr>
			</table>
	 </td>
	</tr> 
	</tbody> 
 </table> 
</body>
</html>';
?>