<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Compare Answer</title>
    <script language="JavaScript" type="text/javascript">
        <!--
        function onSubmit() {

        }
        //-->
    </script>
</head>

<body>
{{--<center>--}}
    {{--<font face="verdana" size="4" color="green" >Please Select the two files, which are to be compared.</font>--}}
{{--</center>--}}
<br/>

{{--<form action="{{route('l_toCompare')}}" method="post" enctype="multipart/form-data">--}}
    {{--<table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-top: medium solid #000000;border-right: medium solid #000000;border-left: medium solid #000000;border-bottom: medium solid #000000">--}}
        {{--<tr >--}}
            {{--<td width="50%" align="center" bgcolor="#ccddff">--}}
                {{--<font face="verdana" size="3" ><b>Select the main file: </b></font>--}}
                {{--<input type="file" name="mainFile"/>--}}
            {{--</td>--}}
            {{--<td width="50%" align="center" bgcolor="#ffccdd">--}}
                {{--<font face="verdana" size="3" ><B>Select the file to be compared: </b></font>--}}
                {{--<input type="file" name="fileToCompare"/>--}}
            {{--</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td colspan="2" align="center">--}}
                {{--<br/>--}}
                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                {{--<input type="submit" value="Start Comparison" name="submitButton" onclick="return onSubmit()"/>--}}
                {{--<br/>--}}
            {{--</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td colspan='2'>--}}
                {{--<br />--}}
            {{--</td>--}}
        {{--</tr>--}}
    {{--</table>--}}
{{--</form>--}}

@if(isset($compareFiles))
<center><font face="verdana" size="6" ><B> Comparison Result </b></font> </center> <br />
<?php
echo "<center><font face='verdana' size='3' color='green'><b>Number of Similar line(s): ". $compareFiles->cnt1."</font><br />";
echo "<BR /><font face='verdana' size='3' color='red'>Number of Different line(s): ". $compareFiles->cnt2."</font></center></b><br />";
?>
<table border="1" style="width:100%;height:400px" cellspacing="0" cellpadding="0">
    <tr>
        <td bgcolor="#ccddff" style="width:50%" >
            <iframe src="file1.html" width="100%" height="400" frameborder='0'  ></iframe>
        </td>
        <td bgcolor="#ffccdd" style="width:50%" >
            <iframe src="file2.html" width="100%" height="400" frameborder='0' ></iframe>
        </td>
    </tr>
</table>
@endif
<center>
    <button name="" value="" class=""><a href="{{URL::previous()}}">Back</a></button>
</center>
</body>
</html>
