
var allCheckedArray=[];    
var allCheckedArrayValues=[];

function checkBoxChecked(id)
{
    if(document.getElementById(id).checked==false)
    {
        var checkinof=allCheckedArray.indexOf(id);
        allCheckedArray.splice(checkinof,1);
        allCheckedArrayValues.splice(checkinof,1);
        
        
    }
    else
    {
        allCheckedArray.push(id);
        allCheckedArrayValues.push($('#'+id).val());
    }    
}


    function checkall()
    {
        var len=document.getElementsByClassName('check_box').length;
       	 a=document.getElementsByName("numbers[]");
         
        if(document.getElementById('check11').checked == true)
        {
            for(i=0;i<a.length;i++)
            {
           	    a[i].checked=true;
                if(!allCheckedArray.inArray(a[i].id)){
                        allCheckedArray.push(a[i].id);
                        allCheckedArrayValues.push($('#'+a[i].id).val());
                    }
            }
        }

        if(document.getElementById('check11').checked == false)
        {
            for(i=0;i<a.length;i++)
            {
                var indofid=allCheckedArray.indexOf(a[i].id);
                allCheckedArray.splice(indofid,1);
                allCheckedArrayValues.splice(indofid,1);
           	    a[i].checked=false
            }
        }
    }

    function checkallEnrolled()
    {
        var len=document.getElementsByClassName('check_box').length;
         a=document.getElementsByName("numbersEnroll[]");
         
        if(document.getElementById('checkenrolled11').checked == true)
        {
            for(i=0;i<a.length;i++)
            {
                a[i].checked=true;
                if(!allCheckedArray.inArray(a[i].id)){
                        allCheckedArray.push(a[i].id);
                        allCheckedArrayValues.push($('#'+a[i].id).val());
                    }
            }
        }

        if(document.getElementById('checkenrolled11').checked == false)
        {
            for(i=0;i<a.length;i++)
            {
                var indofid=allCheckedArray.indexOf(a[i].id);
                allCheckedArray.splice(indofid,1);
                allCheckedArrayValues.splice(indofid,1);
                a[i].checked=false
            }
        }
    }
    
function checkdataForDatatable()
{
        document.getElementById('check11').checked=false;
         var ccc=document.getElementsByName("numbers[]");
         var chkChecked=[];
         var chkNew=[];
         for(i=0;i<ccc.length;i++)
            {
                chkChecked.push(ccc[i].id);
            }
            
            
        // alert(allCheckedArray);
         setTimeout(function(){ 
            
            for(i=0;i<ccc.length;i++)
            {
           	    if(allCheckedArray.inArray(ccc[i].id)){ccc[i].checked=true;
                   chkNew.push(ccc[i].id);}
            }
            
            if(ccc.length==chkNew.length){
                document.getElementById('check11').checked=true;
            }
         },5);
}
