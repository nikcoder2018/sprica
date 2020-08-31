function sweet(){
            Swal.fire({
			title: 'Bitte Veeeeeerifizieren...',
			input: 'text',
            icon: "info",
			inputPlaceholder: 'Passwort eingeben...',
            showCancelButton: true,
			confirmButtonText: '<b>OK</b>',
			cancelButtonText: '<b>ABBRECHEN</b>',
			icon: "warning",
			inputValidator: (value) => {
			return new Promise((resolve) => {
			if (value === '33') {

			window.location.href = "//personal.sprica.de/admin/pages/dokum/dokum.php?UyeID=<?=$_GET["UyeID"]?>&Yil=<?=$_GET["Yil"]?>&Ay=<?=$_GET["Ay"]?>&islemyapildi=1";
			Swal.fire({
			title: 'Monat wurde abgeschlossen',
			icon: "success",
            showConfirmButton: false,
			timer: 2000
						})
																								
							  }
																							  
																							  
								  else {
		   						 resolve('Passwort ist falsch')
                                        }
                                        })
                                        }
							             })
                                        }
