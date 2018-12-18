var  circarr=[]; var calc=[]; locid=[];population=[];center=[];lant=[];long=[];circles1=[];popcen=[];r1=[];r2=[];
poploc=[];locat=[];r3=[];r4=[];popid=[];tblid="";var currentlevelzoom="";var poprad="";zoomsc=[];var general_name;
var scale =["591657550.500000 ","295828775.300000","147914387.600000","73957193.820000","36978596.910000","18489298.450000",
" 9244649.227000","4622324.614000","2311162.307000","1155581.153000"," 577790.576700","288895.288400"," 144447.644200",
"72223.822090"," 36111.911040","18055.955520"," 9027.977761","4513.988880","2256.994440","1128.497220"];
var zoomlevel=["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"];
var cont_share=[];var radcir=[];
function loc_type1(mainloc,subloc,fileid)
{
	$.ajax({
	url:'AjaxRequest.php' ,
	type:"POST",
	data:{"main_location": mainloc,
	"sub_location":subloc,
	"file_id":fileid,
	"mouseover":1,
	},
	success: function (data) {
	location_type=data;
	sessionStorage.setItem("loctype",  location_type);
	}});
}
function removeAllcircles()
{
	for(var i in circles) {
	circles[i].setMap(null);
	}
	circles = [];
}
function zoom(map)
{
	var bounds = new google.maps.LatLngBounds();
	map.data.forEach(function(feature) {
	processPoints(feature.getGeometry(), bounds.extend, bounds);
	});
	map.fitBounds(bounds);

	if($("#map").attr("style")!='height:100%;width:100%;position: relative; overflow: hidden;')
	{

	if(map.getZoom()<6)
	{
	map.setZoom(map.getZoom()+0.7);
	}

	}
}
function removeAllcircles1()
{
	for(var i in circles1) {
	circles1[i].setMap(null);
	}
	circles1 = [];

}   
function sizevalue(mainloc,subloc,d)
{
	d=d/10000000;
	if(mainloc==21 &&subloc==21)
	{
	d=190000;
	return d;

	}//world contient
	else if(mainloc==21 &&subloc==1)
	{
	d=190000;
	return d;

	}  //world country
	else if(mainloc==5 &&subloc==5)
	{

	d=190000;
	return d;
	} //india outline

	else if(mainloc==5 &&subloc==7)
	{
	if(d>100)
	{

	d=190000;
	return d;
	}

	else if(d>90)
	{
	d=180000;
	return d;
	}

	else if(d>80)
	{
	d=170000;
	return d;
	}

	else if(d>70)
	{
	d=160000;
	return d;
	}

	else if(d>60)
	{
	d=150000;
	return d;
	}

	else if(d>50)
	{
	d=140000;
	return d;
	}
	else if(d>40)
	{
	d=130000;
	return d;
	}
	else if(d>30)
	{
	d=120000;
	return d;
	}
	else if(d>20)
	{
	d=110000;
	return d;
	}
	else if(d>10)
	{
	d=100000;
	return d;
	}
	else if(d>5)
	{
	d=90000;
	return d;
	}

	else if(d>0)
	{
	d=86000;
	return d;
	}
	else
	{
	d=9000;
	return d;

	}

	} // india state
	else if(mainloc==7 &&subloc==7)
	{
	d=190000;
	return d;

	} // all one state
	else if(mainloc==7 &&subloc==9)
	{
	if(d>100)
	{

	d=89000;
	return d;
	}

	else if(d>90)
	{
	d=79000;
	return d;
	}

	else if(d>80)
	{
	d=69000;
	return d;
	}

	else if(d>70)
	{
	d=65000;
	return d;
	}

	else if(d>60)
	{
	d=62000;
	return d;
	}

	else if(d>50)
	{
	d=50000;
	return d;
	}
	else if(d>40)
	{
	d=47000;
	return d;
	}
	else if(d>30)
	{
	d=45000;
	return d;
	}
	else if(d>20)
	{
	d=43000;
	return d;
	}
	else if(d>10)
	{
	d=41000;
	return d;
	}
	else if(d>5)
	{
	d=40000;
	return d;
	}

	else if(d>0)
	{
	d=30000;
	return d;
	}
	else
	{
	d=20000;
	return d;

	}

	} // all districts of a state
	else if(mainloc==12 &&subloc==12)
	{
	d=70000;
	return d;

	}  // iso dis
	else if(mainloc==12 &&subloc==15)
	{

	if(d>100)
	{

	d=6000;
	return d;
	}

	else if(d>90)
	{
	d=5500;
	return d;
	}

	else if(d>80)
	{
	d=5000;
	return d;
	}

	else if(d>70)
	{
	d=4700;
	return d;
	}

	else if(d>60)
	{
	d=4200;
	return d;
	}

	else if(d>50)
	{
	d=4100;
	return d;
	}
	else if(d>40)
	{
	d=4000;
	return d;
	}
	else if(d>30)
	{
	d=3500;
	return d;
	}
	else if(d>20)
	{
	d=3000;
	return d;
	}
	else if(d>10)
	{
	d=2700;
	return d;
	}
	else if(d>5)
	{
	d=2000;
	return d;
	}

	else if(d>2)
	{
	d=1900;
	return d;
	}
	else if(d>1)
	{
	d=1200;
	return d;
	}
	else if(d>0)
	{
	d=600;
	return d;
	}
	else
	{
	d=500;
	return d;

	}

	} // all city ward
	else if(mainloc==15 &&subloc==15)
	{
	d=700;
	return d;

	} // single ward
	else
	{
	d=5000;
	return d;
	}
}
function mulfac(mainloc,subloc)
{
	if(mainloc==5 && subloc==7)
	{
	mf=1.2;
	return mf;
	}
	else if(mainloc==7 && subloc==9)
	{
	mf=0.5;
	return mf;
	}
	else
	{
	mf=2;
	return mf;
	}
}

function locationlayer()
{    
   //alert("keerthana");
  // console.log("map",overlay);
	var s; splitname1=[];splitname2=[];
	typeval=$("input[name=type]:checked").val();
	// colorpalat=$(".sp-preview-inner").attr("style");
	// replacol=colorpalat.replace("background-color: ","");
	// replacol1=replacol.replace(");","");
	// replacol2=replacol1.replace("rgb(","");
	// spl= replacol2.split(",");
	// col=rgbToHex(spl[0],spl[1],spl[2]);


	refid=[]; mastername=[];
	if(typeval == 'circle')
	{
    overlay.set(null);
	opacityon="";v="";
	opacityon=$("#custom-handle2").html();
	v=opacityon/100;
	view = sessionStorage.getItem('view');
	year = sessionStorage.getItem('year');
	menu_item_id = sessionStorage.getItem('categs');
	// console.log("currentlevel:",file);
	// alert(view);
	if(view != '' && year != '' && menu_item_id != '')
	{  
	$("#rep").val("circle");   
	 overlay.set(null);
	drawc(map,v);
    
	}

	else
	{ 
     
          // circradius(r1);
	$("#rep").val("circle"); 


	if(file =="SVG/1--21--21.svg" || file =="SVG/1--21--1.svg")
	{


	file1=file.split("SVG/");
	file2=file1[1].split(".svg");
	file3=file2[0].split("---");
	fileid=file3[0];
	fileid=parseInt(fileid);
	mainloc=file3[1];
	mainloc=parseInt(mainloc);
	subloc=file3[2];
	subloc=parseInt(subloc);


	}
	else
	{

	file1=file.split("SVG/");
	file11=file1[1].split("/");
	file2=file11[2].split(".svg");
	file3=file2[0].split("---");
	fileid=file3[0];
	mainloc=file3[1];
	subloc=file3[2];

	}
	//console.log(fileid,mainloc,subloc);
	var passid;var passid1;
	if(mainloc==12 && subloc==12 || subloc==15)
	{     
	year="pop2017";
	}

	else{
	var d = new Date();
	var n = d.getFullYear();
	year=n.toString();
	year="pop"+year
	// console.log(year);
	}

	if(mainloc==21 && subloc==21 )
	{
	passid="world_id";
	mastername="biweb.world_master";
	mastername1="biweb_pca.fifth_combo_district";

	}

	else  if(mainloc==21 && subloc==1 )
	{
	passid1="world_id";
	passid="country_id";
	mastername="biweb.country_master";
	mastername1="biweb_pca.fifth_combo_district";

	}
	else if(mainloc==5 && subloc==5)
	{

	passid="country_id";
	mastername="biweb.country_master";
	mastername1="biweb_pca.fifth_combo_district";
	}
	else if(mainloc==5 && subloc==7)
	{
	passid="state_id";
	passid1="country_id";
	mastername="biweb.state_master";
	mastername1="biweb_pca.fifth_combo_district";
	}
	else if(mainloc==7 && subloc==7)
	{

	passid="state_id";
	mastername="biweb.state_master";
	mastername1="biweb_pca.fifth_combo_district";
	}
	else if(mainloc==7 && subloc==9)
	{

	passid="district_id";
	passid1="state_id";
	mastername="biweb.district_master";
	mastername1="biweb_pca.fifth_combo_district";
	}
	
	else if(mainloc==9 && subloc==9)
	{
	passid="district_id";
	mastername="biweb.district_master";
	mastername1="biweb_pca.fifth_combo_district";
	}
	else if(mainloc==12 && subloc==12)
	{
	passid="city_id";
	mastername="biweb.city_master";
	mastername1="biweb_pca.fifth_combo_city";
	if(fileid==73)
	{
	fileid=14878;
	}

	else if(fileid==676)
	{
	fileid=13346;
	}
	else if(fileid==25)
	{
	fileid=13623 ;
	}
	}

	else if(mainloc==12 && subloc==15)
	{
	passid="ward_id";
	passid1="city_id";
	mastername="biweb.ward_master";
	mastername1="biweb_pca.fourth_combo_ward";
	if(fileid==73)
	{
	fileid=14878;
	}

	else if(fileid==676)
	{
	fileid=13346;
	}
	else if(fileid==25)
	{
	fileid=13623 ;
	}
	}


	else if(mainloc==9 && subloc==10)
	{

	passid="taluk_id";
	passid1="district_id";
	mastername="biweb.taluk_master";
	mastername1="biweb_pca.taluk_fifth_combo";


	}

	else if(mainloc==10 && subloc==10)
	{

	passid="taluk_id";
	mastername="biweb.taluk_master";
	mastername1="biweb_pca.taluk_fifth_combo";
	//alert("response");
	locid=[];
	$.ajax({
	type: "POST",
	url: "village_master.php",
	data:{'fileid':fileid,},
	success: function (response)
	{
	map.data.forEach(function(feature) {

	map.data.remove(feature);

	});
	g=JSON.parse(response); 
	//console.log(g);
	for(i=0;i<g.length;i++)
	{

	locid[i]=g[i].state_id;

	}
	tblid=locid[0];
	tblid=tblid.toString();
	//console.log("tblid",tblid);
	}      

	});
	}
	else if(mainloc==10 && subloc==14)
	{

	passid="village_id";
	passid1="taluk_id";
	mastername="biweb.village_master";
	mastername1="biweb_pca.village_gender_"+tblid;
	
	}

	else if(mainloc==13 && subloc==13)
	{
	passid="village_id";
	mastername="biweb.village_master";
	mastername1="biweb_pca.village_gender_"+tblid;              
	}
	else if(mainloc==14 && subloc==14)
	{
	passid="village_id";
	mastername="biweb.village_master";
	mastername1="biweb_pca.village_gender_"+tblid;              
	}
	else
	{
	passid='';
	}
	function circleajax(url)
	{
		$.ajax({
		type: "POST",
		url: url,
		data:{
		'fileid':fileid,
		'mainloc':mainloc,
		'subloc':subloc,
		'passid':passid,
		'passid1':passid1,
		'mastername':mastername,
		'mastername1':mastername1,
		'year':year,
		},
		async:false,

		success: function (response)
		{
		circles1=[];


		map.data.forEach(function(feature) {

		map.data.remove(feature);

		});

     

		removeAllcircles1();           

		g=JSON.parse(response); 
		//console.log(g);
		locid=[];population=[];center=[];locat=[];popcen=[];poploc=[];popid=[];
		for(i=0;i<g.length;i++)
		{

		locid[i]=g[i].locid;
		population[i]=Math.round(g[i].result);
		center[i]=g[i].center_coordinates;
		locat[i]=g[i].location_name;
		popcen.push({
		key1:population[i],//id
		value1:center[i]// area value
		});  
		poploc.push ({
		key1:population[i],//id
		value1:locat[i]// area value
		}); 
		popid.push ({
		key1:population[i],//id
		value1:locid[i]// area value
		}); 
		}
		//circradius(population);
		sessionStorage.setItem("pop",population);
		colorcodeid2=colorgradientcreation(population,0);
		popcen.sort(function(a, b) {
		return parseFloat(b.key1) - parseFloat(a.key1);
		}); 
		poploc.sort(function(a, b) {
		return parseFloat(b.key1) - parseFloat(a.key1);
		});
		popid.sort(function(a, b) {
		return parseFloat(b.key1) - parseFloat(a.key1);
		});
		

		r1=[];r2=[];r3=[];r4=[];lant=[];long=[];
		poprad="";
		for(i=0;i<popcen.length;i++)
		{

		r1[i]=popcen[i].key1;//population
		r2[i]=popcen[i].value1;//geocode
		r3[i]=poploc[i].value1;//locationname
		r4[i]=popid[i].value1;

		if(mainloc==7 && subloc==9)
		{
		poprad=r1[i]/100; 
		}
		else if(mainloc==12 && subloc==15)
		{
		poprad=r1[i]/100; 
		}
		else if(mainloc==9 && subloc==10)
		{
		poprad=r1[i]/100; 

		}

		else if(mainloc==10 && subloc==14)
		{
		poprad=r1[i]; 

		}

		else if(mainloc==9 && subloc==10)
		{
		poprad=r1[i]/100; 

		}
		else
		{
		poprad=r1[i]/1000; 
		}
		
		poprad1=Math.round(parseFloat(poprad));
		
		arr=r2[i].split(",");
		lant[i]=arr[0];
		long[i]=arr[1];
		circle1= new google.maps.Circle({
		strokeColor: colorcodeid2[0][i],
		strokeOpacity:0.7,
		strokeWeight: 2,
		fillColor:colorcodeid2[0][i],
		fillOpacity:v,
		map: map,
		center:new google.maps.LatLng(lant[i],long[i]),
		radius:poprad1,
		name:r3[i],
		value:r1[i],
		id:r4[i]
		}); 
		circles1.push(circle1);

		currentlevelzoom=map.getZoom();
		
		circarr.push(poprad);
		divfac=100000000;

		g=circarr[i]/100000000;

           console.log(r1[i]);
		calc.push(g);
		

		   google.maps.event.addListener(circle1,'mouseover',function(){
			
			var loctypemap=sessionStorage.getItem('loctype');
	        this.getMap().getDiv().setAttribute('title',this.get('name')+"-"+loctypemap);	
			//alert(this.get('id'));
			
		});

		google.maps.event.addListener(circle1,'mouseout',function(){
		this.getMap().getDiv().removeAttribute('title');
		});

		google.maps.event.addListener(circle1,'dblclick',function(){
		
		removeAllcircles();
		removeAllcircles1() ;
		mapname="";
		mapname=this.name;

           
		$.ajax({
		type: "POST",
		url: "AjaxRequest.php",
		data:{"nextlevel":"nextlevel","id":this.id,"currentlevel":file},
		async:false,

		success: function (data)
		{
		//console.log(data);
		nextlevelfile = data;
		alert(nextlevelfile);
		initlayer(map,nextlevelfile,0,1,'');
		var loctypemap=sessionStorage.getItem('loctype');

		if(mainloc==subloc)
		{
		$("#mapname").text(mapname+"-"+loctypemap);
		general_name =mapname+"-"+loctypemap;
		}
		else if(mainloc=="21"&&subloc=="1")
		{
		$("#mapname").text("Country");
		}
        else
		{
		$("#mapname").text(general_name);

		}
        }
		});
		});

		}
		// console.log(r1);
  //         circradius(r1); 
		var cirbounds = new google.maps.LatLngBounds();

		$.each(circles1, function(index, circle){
		cirbounds.union(circle.getBounds());

		});
		map.fitBounds(cirbounds);

		if(mainloc==5 && subloc==7)
		{
		zoomcircle(circles1,20,2,'','');

		}

		else
		{
		if(mainloc!=5 && subloc!=5)
		{
		zoomcircle(circles1,22,2,'','');
		}
		else if(mainloc==13 && subloc==13)
		{
		zoomcircle(circles1,20,2,'','');
		}
        else if(mainloc==10 && subloc==13)
		{
		zoomcircle(circles1,20,2,'','');
		}

		}
	    }
		});
	}
	if(mainloc!=13 && subloc!=14)
	{
		loc_type1(mainloc,subloc,fileid);
      circleajax("population.php");
     //console.log(sessionStorage.getItem("pop"));
     var s=sessionStorage.getItem("pop");
     t=s.split(",");
     console.log(t);
   result_total=0;
var sum = t.reduce(add, 0);

function add(a, b) {
    return a + b;
}

console.log(Math.round(sum));

    // for($i=0;$i<t.length;i++)
    // {
    //  result_total=result_total+t[i];
    //    console.log("dynamic_rad",result_total);
    // }
    // for($i=0;$i<t.length;i++)
    // {
    //  cont_share[i]=r1[i]/result_total*100;	
     
    // }
    // startrd=200;endrd=5;
    //   for($i=0;$i<r1.length;i++)
    // {
    //   radcir[0]=200;
    //  radcir[i+1]=startrd/cont_share[i-1]*cont_share[i];
    //   startrd="";
    //   startrd=radcir[i+1];
    //   if(radcir[i]<5)
    //   {
    //   	radcir[i]=5;
    //   }
    // }
  
     

    }


	else
	{
		loc_type1(mainloc,subloc,fileid);
	  circleajax("village_population.php");
	}

	}


	}

	if(typeval =='poly')

	{
	//map.set(null);

	$("#rep").val("");
	opacity=$("#custom-handle2").html();
	opacity1=$("#custom-handle1").html();
	v=opacity/100;
	v1=opacity1/100;
	polycol=col;
	view = sessionStorage.getItem('view');
	$('.loading', window.parent.document).show();
	removeAllcircles() ;
	$('.loading', window.parent.document).hide();
	if(view=='')
	{
	removeAllcircles() ;
	removeAllcircles1();  
	}
	else
	{
	removeAllcircles() ;
	removeAllcircles1();  
	initlayer(map,file,0,0,'');
	map.data.setStyle(function(feature) {
	if(colorcodeid[feature.getProperty('DB_ID')]!=undefined)
	{
	return {
	strokeColor:  "#000000",
	strokeOpacity: v,
	strokeWeight: 1,
	fillColor:colorcodeid[feature.getProperty('DB_ID')],
	fillOpacity: v,

	};
	}
	else
	{

	return {
	strokeColor:  "#000000",
	strokeOpacity: 1,
	strokeWeight: 1,
	fillColor:"#FFFFFF",
	fillOpacity:v,

	};

	}

	});
	}


}

   //  typeval='';
   // typeval=$("input[name=type]:checked").val();
  // if(typeval =='svg')
  // {
  //   alert("keerthana");
  // locid=  sessionStorage.getItem('id');
  // parentlvl = sessionStorage.getItem('parentlvl');
  // childlvl =sessionStorage.getItem('childlvl');
  // locationid=(locid==73) ? 14878 :locid;

  // svgname = locationid+'---'+parentlvl+'---'+childlvl;

  // svgexecution_st(svgname,testarr);
  // }
$(".close").click();
$(".modal-backdrop.fade.in").remove();
}


function zoomcircle(circles,fa,ma,mainloc,subloc)
{              
	map.addListener('zoom_changed', function() 
	{

	if( map.getZoom()>=currentlevelzoom)
	{
	for(i=0;i<circles.length;i++)
	{
	r=circles[i].getRadius();
	circarr.push(r);
	divfac=100000000;
	g=(r/100000000);
	calc.push(g);

	var p = Math.pow(ma, (fa - map.getZoom()));

	if(mainloc==12 && subloc==15)
	{
	circles[i].setRadius((p*1128.497220*calc[i])/10);	
	}
	else
	{
	circles[i].setRadius(p*1128.497220*calc[i]);
	}


	}

	calc[0]=calc[1];
	}
	});
}


function backcircle()
{
	
	removeAllcircles() ;
	removeAllcircles1() ;
	$('.loading', window.parent.document).show();

	backfile=historyarr[historyarr.length-2];
	zooml=zoomarr[zoomarr.length-2];

	statuscode=UrlExists(baseurl+backfile);

	setTimeout(function(){

	if(statuscode == statuscode)
	{
	var callback = function(feature)
	{
	map.data.remove(feature);
	};
	map.data.forEach(callback);
	var length=historyarr.length-1;
	historyarr.splice(length, 1);
	var length1=zoomarr.length-1;
	zoomarr.splice(length, 1);
	$('.loading', window.parent.document).hide();
	mapname =sessionStorage.getItem('mname');

	// if(view != '' && year != '' && menu_item_id != '')
	// {        
	initlayer(map,backfile,1,1,zooml);
	//}

	if(backfile=="SVG/1---21---21.svg" || backfile=="SVG/1---21---1.svg")
	{

	file1=backfile.split("SVG/");
	file2=file1[1].split(".svg");
	file3=file2[0].split("---");
	fileid=file3[0];
	fileid=parseInt(fileid);
	mainloc=file3[1];
	mainloc=parseInt(mainloc);
	subloc=file3[2];

	}
	else
	{




	file1=backfile.split("SVG/");
	file11=file1[1].split("/");
	file2=file11[2].split(".svg");
	file3=file2[0].split("---");
	fileid=file3[0];
	mainloc=file3[1];
	subloc=file3[2];	
	subloc=parseInt(subloc);

	file11=file.split("SVG/");
	file111=file11[1].split("/");
	file21=file111[2].split(".svg");
	file31=file21[0].split("---");
	fileid1=file31[0];
	mainloc1=file31[1];
	subloc1=file31[2];	
	subloc1=parseInt(subloc1);

	}
	}

	else
	{
	$.alert({
	title: '',
	content: 'Data Not Available',
	boxWidth: '30%',
	top:-500,
	offsetTop: 70,
	useBootstrap: false,
	});
	}
	},500);
}


function drawc(map1,v)

{
//loc_type1(mainloc,subloc,fileid);

	$("#rep").val("circle");
	$("#clear").trigger("click");
	size=$("#custom-handle1").html()*1000; 



	filesplit3=[]; filesplit5=[]; filesplit7=[];



	if(file=="SVG/1---21---21.svg" || file=="SVG/1---21---1.svg")
	{


	file1=file.split("SVG/");
	file2=file1[1].split(".svg");
	file3=file2[0].split("---");
	fileid=file3[0];
	fileid=parseInt(fileid);
	mainloc=file3[1];
	mainloc=parseInt(mainloc);
	subloct=file3[2];
	subloct=parseInt(subloct);
   loc_type1(mainloc,subloc,fileid);


	}
	else
	{
     console.log("recreating circle",file);
	file1=file.split("SVG/");
	file11=file1[1].split("/");
	file2=file11[2].split(".svg");
	file3=file2[0].split("---");
	fileid=file3[0];
	mainloc=file3[1];
	subloct=file3[2];	
	//console.log(fileid,mainloc,subloc);
     loc_type1(mainloc,subloc,fileid);

	}


	click=0;
	if(mainloc!= subloct)
	{

	if(click>1)
	{
	subloc1=historyarr[parseInt(historyarr.length-1)];

	}
	else
	{
	subloc1=historyarr[parseInt(historyarr.length-2)];
	}


	filea= subloc1.split("SVG/");
	fileb=filea[1].split(".svg");
	filec=fileb[0].split("---");
	subloc=file3[2];
	}
	else
	{
	subloc=file3[2];

	}


	$.ajax({
	url:'AjaxRequest.php' ,
	type:"POST",
	data:{"drawshape":1,
	"mainlocation": mainloc,
	"sublocation": subloc,

	},

	success: function(response)
	{


	refid=[];mastername=[];
	mastername3=response.toString();
	mastername3=mastername3.split("_");



	if(mainloc!=subloct)
	{

	passid='';
	if(mainloc=='12'&& subloct=='15')
	{

	passid="city_id";
	}
	else if(mainloc=='5'&& subloct=='7')
	{
	passid="country_id";

	}

	else if(mainloc=='7'&& subloct=='9')
	{
	passid="state_id";

	}
	else if(mainloc=='9'&& subloct=='10')
	{
	passid="district_id";

	}
	else if(mainloc=='10'&& subloct=='14')
	{
	passid="taluk_id";

	}
	else if(mainloc=='14'&& subloct=='14')
	{
	passid="village_id";

	}

    }

	else
	{
	passid= "refid";
	}


	map1.data.forEach(function(feature) {

	map1.data.remove(feature);
	//map.data.setMap(null);
	});
	combinesplit_res();

	s= sessionStorage.getItem('getstate_data');  //sessionStorage.getItem("clickresult");
	s = JSON.parse(s);
	s= s.toString();
	s=s.split(",");

	idvalue=[];key=[];value=[];id=[];valuearr=[];
	for(i=0;i<s.length;i++)
	{
	s1=s[i].toString();
	s1=s1.replace("****"," ,");
	s1=s1.split(",");
	s2=s1[1].toString();
	s2=s2.replace("****",",");
	s2=s2.split(",");

	id.push(s1[0]);//map id
	//console.log("res",id[i]);
	valuearr.push(s2[0]);//value of area
    idvalue.push({
	key1:id[i],//id
	value1:valuearr[i]// area value
	});

	key[i]=idvalue[i].key1;
	value[i]=idvalue[i].value1;
	// console.log("result key",key[i]);
	}




	if(fileid==676)
	{

	fileid=13346;

	}
	else  if(fileid==73)
	{

	fileid=14878;

	}
	else  if(fileid==25)
	{
	fileid=13623;
	}

	//sessionStorage.setItem("cm",mastername[0]);
	if(mainloc=='10'&& subloct=='14')
	{
	mast="village_master";

	}
	else if(mainloc=='14'&& subloct=='14')
	{
	mast="village_master";
	}

	else if(mainloc=='13'&& subloct=='13')
	{
	mast="village_master";
	}
	else
	{
	mast=mastername3[0];

	}

	$.ajax({
	url:'AjaxRequest.php' ,
	type:"POST",
	data:{
	"circle_result":1,	
	"mastername1":mast,
	//"refid1":refid[0],
	"fileid1":fileid,
	"passid1":passid,


	},

	success: function(response)
	{
	console.log(response);
	t =JSON.parse(response);

	geo=[];lanlat=[];geoid=[];dblocname=[];key2=[];key4=[];value2=[];value4=[];
	iddb=[];locationname=[];
	for(i=0;i<t.length;i++)
	{
	geo = t[i].split(',');
	lanlat.push(geo[0]+","+geo[1]);

	iddb.push(geo[2]);
	locationname.push(geo[3]);
	geoid.push({
	key1:iddb[i],//db id
	value1:lanlat[i]//db geocode
	});
	dblocname.push({
	key1:iddb[i],//id
	value1:locationname[i]// area value
	});
	key2[i]=geoid[i].key1;
	value2[i]=geoid[i].value1;
	// console.log("db key",key2[i]);
	key4[i]=dblocname[i].key1;
	value4[i]=dblocname[i].value1;



	}




	geovalue=[];circleid=[];geolocname=[];circleid1=[]; value3 =[];  key3 =[];  value5 =[];
	key5=[]; geocode=[]; lan=[]; lat=[];  colorcodeid1=[];
	colorcodeid1=colorgradientcreation(s,0);

	for(i=0;i<key.length;i++)

	{
	// console.log(key[i]+","+"check1");
	if(key[i]==676)
	{
	if(passid=="refid" && mainloc==12 && subloc==12)
	{



	key[i]="13346 ";
	//alert(key[i]+","+"check1");
	}

	if(passid=="refid" && mainloc==12 && subloc==15)
	{



	key[i]="13346 ";
	//alert(key[i]+","+"check1");
	}
	}


	if(key[i]==73)
	{
	if(passid=="refid" && mainloc==12 && subloc==12)
	{



	key[i]="14878 ";
	//alert(key[i]+","+"check1");
	}
	if(passid=="refid" && mainloc==12 && subloc==15)
	{



	key[i]="14878 ";
	//alert(key[i]+","+"check1");
	}
	}
	if(key[i]==25)
	{
	if(passid=="refid" && mainloc==12 && subloc==12)
	{



	key[i]="13623 ";
	// alert(key[i]+","+"check1");
	}
	if(passid=="refid" && mainloc==12 && subloc==15)
	{
	removeAllcircles();


	key[i]="13623 ";
	// alert(key[i]+","+"check1");
	}
	}
	for(j=0;j<key2.length;j++)
	{

	if(parseInt(key[i])==parseInt(key2[j]))
	{


	geovalue.push({
	key1:value2[j],//id
	value1:value[i]// area value
	});circleid.push({
	key1:key[i],//id
	value1:value[i]// area value
	});geolocname .push({
	key1:value[i],//value
	value1:value4[j]// location
	});


	}

	else if(mainloc==10 && subloc==14)
	{

	geovalue.push({
	key1:value2[j],//id
	value1:value[i]// area value
	});circleid.push({
	key1:key[i],//id
	value1:value[i]// area value
	});geolocname .push({
	key1:value[i],//value
	value1:value4[j]// location
	});




	}
	else if(mainloc==14 && subloc==14)
	{

	geovalue.push({
	key1:value2[j],//id
	value1:value[i]// area value
	});circleid.push({
	key1:key[i],//id
	value1:value[i]// area value
	});geolocname .push({
	key1:value[i],//value
	value1:value4[j]// location
	});

    }
	

	}
	circleid1[i]=circleid[i].key1;
	value3[i]=geovalue[i].value1;
	key3[i]=geovalue[i].key1;
	value5[i]=geolocname[i].value1;//location name
	key5[i]=geolocname[i].key1;

	geocode = key3[i].split(',');
	lan.push(geocode[0]);
	lat.push(geocode[1]);
	if(mainloc==5 && subloc==5)

	{
	poprad=190000; 

	}
	else if(mainloc==5 && subloc==7)

	{
	poprad=value3[i]/1000; 

	}
	else if(mainloc==7 && subloc==7)

	{
	poprad=value3[i]/1000; 

	}
	else if(mainloc==7 && subloc==9)

	{
	poprad=value3[i]/100; 

	}
	else if(mainloc==9 && subloc==9)

	{
	poprad=value3[i]/1000; 

	}
	else if(mainloc==12 && subloc==	12)

	{
	poprad=value3[i]/1000; 

	}
	else
	{
	poprad=value3[i]/100; 
	}



	poprad1=Math.round(parseFloat(poprad));
	circleid1[i] =  circleid1[i].replace(/^\s\s*/, '').replace(/\s\s*$/, '');
	circle= new google.maps.Circle({
	strokeColor: colorcodeid1[0][i],
	strokeOpacity:0.7,
	strokeWeight: 2,
	fillColor:colorcodeid1[0][i],
	fillOpacity:v,
	map: map,
	center:new google.maps.LatLng(lan[i],lat[i]),
	radius:poprad1,
	id:circleid1[i],
	name:value5[i],
	value:value3[i]
	});

	circles.push(circle);
	radius.push(circle.getRadius());
	console.log("circle(drawn)",circle);

    
	circle.addListener('mouseover',function(event)
	{
	//mapname(mainloc,subloc,mainloc1,subloc1,fileid);
	var type_loc="";
	type_loc = sessionStorage.getItem("loctype");
	var title1 = this.name;
	title1 =" <b> "+title1+"-"+ " </b>"+ type_loc+":"+Math.round(this.get('value'))+"<br>";
	injectTooltip(event, title1);
	title="";
	});
	circle.addListener('mouseout',function(event)
	{
	deleteTooltip(event);
	});

	circle.addListener('dblclick',function(event)
	{

	removeAllcircles() ;


	mapname="";
	mapname=this.name;

	sessionStorage.setItem('mname',mapname);

	$.ajax({
	type: "POST",
	url: "AjaxRequest.php",
	data:{"nextlevel":"nextlevel","id":this.id,"currentlevel":file},
	async:false,

	success: function (data)
	{
	map1.data.forEach(function(feature) {

	map1.data.remove(feature);
	});
	nextlevelfile1 = data;
         nextlevelfile11=nextlevelfile1.split("//");
         nextlevelfile=nextlevelfile11[0];   
          
        svgpath = nextlevelfile.replace('kml','svg');
        svgpath = svgpath.replace('KML','SVG');

	if(svgpath=="SVG/1---21---21.svg" || svgpath=="SVG/1---21---1.svg")
	{

	file1=svgpath.split("SVG/");
	file2=file1[1].split(".svg");
	file3=file2[0].split("---");
	fileid1=file3[0];
	mainloc1=file3[1];
	subloc1=file3[2];
	}
	else
	{
	file1=svgpath.split("SVG/");
	file11=file1[1].split("/");
	file2=file11[2].split(".svg");
	file3=file2[0].split("---");
	fileid=file3[0];
	mainloc=file3[1];
	subloct=file3[2];	


	}
   console.log("just",svgpath);


	if (svgpath !=undefined)
	{
	statuscode=UrlExists(baseurl+svgpath);
	if(statuscode == statuscode)

	initlayer(map1,svgpath,0,1,'');
    loc_type1(mainloc,subloc,fileid);
    type_loc = sessionStorage.getItem("loctype");
	if(mainloc==subloc)
	{
	$("#mapname").text(mapname+"-"+type_loc);
	general_name =mapname+"-"+type_loc;
	}
	else
	{
	$("#mapname").text(general_name);

	}



	if(mainloc=="21"&&subloc=="1")
	{
	$("#mapname").text("Country");
	}






	map1.data.forEach(function(feature) {

	map1.data.remove(feature);
	});


	$('.loading', window.parent.document).hide();

	}
	else
	{
	$('.loading', window.parent.document).hide();
	$.alert({
	title: '',
	content: 'Data Not Available',
	boxWidth: '30%',
	top:-500,
	offsetTop: 70,
	useBootstrap: false,
	});

	}



	}
	});

	view = sessionStorage.getItem('view');

	if(view != '')
	{
	$('.loading', window.parent.document).show();

	//combinesplit_res(1);
	}



	});//CIRCLE DOUBLE CLICK
	}
	var cirbounds = new google.maps.LatLngBounds();


	if(mainloc==5 && subloc==7)
	{
	zoomcircle(circles,20,2,'','');

	}

	else
	{
	if(mainloc!=5 && subloc!=5)
	{
	zoomcircle(circles,22,2,'','');
	}


	}

	$.each(circles, function(index, circle){
	cirbounds.union(circle.getBounds());

	});
	map1.fitBounds(cirbounds)



	}
	});//AJAX 2ND


	}});// AJAX 1ST

	click++;


}//FUNCTION 


