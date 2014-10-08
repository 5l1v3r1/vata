/**
 * Created by Passika on 01.03.14.
 */
$(document).ready(function () {

	if (window.location.hash == '#_=_') window.location.hash = '';
	$(".login-button").click(function(){

		var link = $(this).attr('data-href');

		$.ajax({

			url: "/ajax/index/",
			type:"post",
			data:{

				"urlsaver" : $(location).attr('href')

			},
			complete: function(){

				window.location.href = link;

			}

		});


	});

	/* ADMIN PANEL*/

	$(".drop-terrorist").click(function(){

		$.ajax({

			url: "/ajax/album/",
			type:"post",
			data:{

				"dropAlbum" : $(this).attr('data-id')

			},complete: function(){

				window.location.reload();

			}

		});

	});

	$(".drop-terror-img").click(function () {

		var par = $(this).parent();

		$.ajax({

			url: "/ajax/album/",
			type: "post",
			data: {

				"dropImg": $(this).attr('data-id')

			}, complete: function () {

				par.remove();

			}

		});

	});

	$(".save-terrorist").click(function(){

		$.ajax({

			url: "/ajax/album/",
			type:"post",
			data:{

				"saveAlbum" : $(this).attr('data-id')

			},complete: function(){

				window.location.reload();

			}

		});

	})

	$(".sorting-select").change(function(){

		$(".sort-form").submit();

	})

	$(".lang-select").click(function(){

		var lang = $(this).attr("data-lang");
		var page = $(this).attr("data-href");

		$.ajax({

			url: "/ajax/index/",
			type:"post",
			data:{

				"language" : lang,
				"page" : page

			},success: function(response){

				window.location.href=response.link
				return false;
			}

		});

	})

	$(".drop-article").click(function(){

		$.ajax({

			url: "/ajax/album/",
			type:"post",
			data:{

				"dropArticle" : $(this).attr('data-id')

			},complete: function(){

				window.location.reload();

			}

		});

	});

	$(".approve-article").click(function(){

		$.ajax({

			url: "/ajax/album/",
			type:"post",
			data:{

				"approveArticle" : $(this).attr('data-id')

			},complete: function(){

				window.location.reload();

			}

		});

	});

	$(".drop-facebook").click(function(){

		$.ajax({

			url: "/ajax/album/",
			type:"post",
			data:{

				"dropFacebook" : $(this).attr('data-id')

			},complete: function(){

				window.location.reload();

			}

		});

	});

	$(".ban-user").click(function(){

		$.ajax({

			url: "/ajax/user/",
			type:"post",
			data:{

				"banUser" : $(this).attr('data-id')

			},complete: function(){

				window.location.reload();

			}

		});

	});

	$(".send-propose").click(function(){

		var name = $("#proposerName").val();
		var email = $("#proposerEmail").val();
		var text = $("#proposerReason").val();

		if(text){

			$.ajax({

				url: "/ajax/album/",
				type:"post",
				data:{

					"propose" : 1,
					"name" : name,
					"email" : email,
					"text" : text

				},success: function(response){

					$('#myDelete').modal('toggle');

				}

			});

		}else{

			$("#proposerReason").focus();

		}

		return false;

	});

	$("#TerrorObl").change(function(){

		var obl = $(this).val();
		$("#TerrorCity").attr("disabled", "disabled");
		$.ajax({

			url: "/ajax/user/",
			type:"post",
			data:{

				"getCityByObl" : obl

			},success: function(response){

				$("#TerrorCity").html(response.city);
				$("#TerrorCity").removeAttr("disabled");

			}

		});

	});

	$(".is_main").click(function(){

		var img = $(this).val();

		$.ajax({

			url: "/ajax/user/",
			type:"post",
			data:{

				"mainImg" : img

			},success: function(response){

				$("#cropSrc").attr("src", response.img);
				$("#cropImg").modal("toggle");

			}

		});

	});

	$('#cropImg').on('shown.bs.modal', function (e) {
		$('img#cropSrc').imgAreaSelect({x1: 0, y1: 0, x2: 270, y2: 200});
	})
	$('#cropImg').on('hide.bs.modal', function (e) {
		$('img#cropSrc').imgAreaSelect({hide:true})
	})

	$(".cropIt").click(function(){

		$.ajax({

			url: "/ajax/user/",
			type:"post",
			data:{

				"imageCrop" : $("#cropSrc").attr("src"),
				"x1" : $('input[name="x1"]').val(),
				"y1" : $('input[name="y1"]').val(),
				"x2" : $('input[name="x2"]').val(),
				"y2" : $('input[name="y2"]').val()

			},success: function(response){

				$('img#cropSrc').imgAreaSelect({hide:true})
				$("#cropImg").modal("toggle");

			}

		});

		return false;

	})

});


