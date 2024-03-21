	 function FaqToggleDetail ( id ){

		var latestToggleObj = null;

		var oObj = document.getElementById( id );	




		if( this.latestToggleObj != null ){

			this.latestToggleObj.className = (this.latestToggleObj.className + " none");

		}

		if( this.latestToggleObj == oObj ){

			this.latestToggleObj = null;

			return;

		}

		this.latestToggleObj = null;


 

		if( oObj.className.indexOf( "none" ) != -1 ){

			oObj.className = oObj.className.replace( "none", "" );			

		}else{

			oObj.className = (oObj.className + " none");

		}

		this.latestToggleObj = oObj;

	 }