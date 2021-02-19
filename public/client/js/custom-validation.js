$(document).ready(function () {

    $.validator.addMethod('Validemail', function (value, element) {
        return this.optional(element) || value.match(/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/);
    }, "Please enter a valid email address.");
    
    $('#GuestUrlShortForm').validate({
        rules: {
            client_website_url: {
                required: true
            }
        },
        messages: {
            client_website_url: {
                required: "Please enter valid URL.",
            }
        },
        submitHandler: function (form) {
            if ($('#GuestUrlShortForm').valid()) {
                $.ajax({
                    url: $('#GuestUrlShortForm').attr('action'),
                    type: "POST",
                    data: $('#GuestUrlShortForm').serialize(),
                    success: function (data) {
                        if (data.user_status == "registered" && data.status == "success") {
                            $('#client-url-one-error-msg').html("Total links left: " + data.links_left);
                            $('#GuestUrlShortForm').trigger("reset");
                            Swal.fire({
                                type: "success",
                                title: "Done!",
                                text: data.msg,
                                confirmButtonClass: "btn btn-success"
                            }).then(function (confirm) {
                                if (confirm.value == true) {
                                    $('#GuestUserDataModal').modal('show');
                                    $('.GuestUserDataForm').hide();
                                    setTimeout(function () {   
                                        $('.GuestUserDataForm .guest-user-form-title').html("Generated Link");
                                        $('#guest-user-link-block').show();
                                        $("#guest-user-link-block,#generated_link").val(data.link);
                                        $('.share-link-block').html(data.share_links);
                                        // $('.GuestUserDataForm,#btn-guest-share-fb').attr('data-generated_link', data.link);
                                        // $('.GuestUserDataForm,#btn-guest-share-twitter').attr('data-generated_link', data.link);
                                        // $('.GuestUserDataForm,#btn-guest-share-linkedin').attr('data-generated_link', data.link);
                                        // $('.GuestUserDataForm,#btn-guest-share-linkedin').attr('data-website_url', $('#client_website_url').val());
                                        // $('.GuestUserDataForm,#btn-guest-share-mail').attr('data-generated_link', data.link);
                                    }, 300);
                                }
                            })
                        } else if (data.status == "success" && data.user_status == "guest") {
                            $('#GuestUserDataModal').modal('show');
                            $('#GuestUserDataForm,#guest_website_url').val($('#client_website_url').val());
                        } else if (data.status == "link-fail") {
                            $('#GuestUrlShortForm').trigger("reset");
                            Swal.fire({
                                type: "error",
                                title: "Failed!",
                                text: data.msg,
                                showCancelButton: 1,
                            })
                        } else if (data.status == "limit-exhausted") {
                            $('#GuestUrlShortForm').trigger("reset");
                            Swal.fire({
                                type: "warning",
                                title: "Sorry!",
                                text: data.msg,
                                confirmButtonClass: "btn btn-success",
                                showCancelButton: true,
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, upgrade it!'
                            }).then(function (confirm) {
                                if (confirm.value == true) {
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function () {
                        setTimeout(function () {
                            $('#overlay').fadeOut(300);
                        },500);
                    }
                }).done(function () {
                    setTimeout(function () {
                        $('#overlay').fadeOut(300);
                    }, 500);
                });
            }
        }
    });

    $('#GuestUserDataForm').validate({
        rules: {
            guest_firstname: {
                required: true
            },
            guest_lastname: {
                required: true
            },
            guest_email: {
                required: true,
                Validemail:true
            },
            guest_phone_number: {
                required: true,
                digits:true,
                minlength: 10,
                maxlength:10
            },
        },
        messages: {
            guest_firstname: {
                required: "Please enter your firstname."
            },
            guest_lastname: {
                required: "Please enter your lastname."
            },
            guest_email: {
                required: "Please enter your valid email address."
            },
            guest_phone_number: {
                required: "Please enter your phone number.",
                minlength: "Phone number should be atleast 10 digits.",
                maxlength: "Phone number must have only 10 digits."
            },
        },
        submitHandler: function (form) {
            if ($('#GuestUserDataForm').valid()) {
                $.ajax({
                    url: $('#GuestUserDataForm').attr('action'),
                    type: "POST",
                    data: $('#GuestUserDataForm').serialize(),
                    success: function (data) {
                        if (data.result == "success") {
                            $('#GuestUserDataForm').trigger("reset");
                            $('#GuestUrlShortForm').trigger("reset");
                            $('#GuestURLShortTypes').trigger("reset");
                            $('#client-url-two-error-msg').html("Total links left: " + data.links_left);
                            Swal.fire({
                                type: "success",
                                title: "Done!",
                                text: data.msg,
                                confirmButtonClass: "btn btn-success"
                            }).then(function (confirm) {
                                if (confirm.value == true) {
                                    $('.GuestUserDataForm').slideUp();
                                    setTimeout(function () {
                                        $('.GuestUserDataForm .guest-user-form-title').html("Generated Link");
                                        $('#guest-user-link-block').slideDown();
                                        $('#guest-user-link-block').show();
                                        $("#guest-user-link-block,#generated_link").val(data.link);
                                        $('.share-link-block').html(data.share_links);
                                        // $('.GuestUserDataForm,#btn-guest-share-fb').attr('data-generated_link', data.link);
                                        // $('.GuestUserDataForm,#btn-guest-share-twitter').attr('data-generated_link', data.link);
                                        // $('.GuestUserDataForm,#btn-guest-share-linkedin').attr('data-generated_link', data.link);
                                        // $('.GuestUserDataForm,#btn-guest-share-linkedin').attr('data-website_url', $('#client_website_url').val());
                                        // $('.GuestUserDataForm,#btn-guest-share-mail').attr('data-generated_link', data.link);
                                    },1000);
                                }
                            })
                        } else if (data.result = "link-fail") {
                            $('#GuestURLShortTypes').trigger("reset");
                            Swal.fire({
                                type: "error",
                                title: "Failed!",
                                text: data.msg,
                                showCancelButton: 1,
                            });
                        } else if (data.status == "limit-exhausted") {
                            $('#GuestURLShortTypes').trigger("reset");
                            Swal.fire({
                                type: "warning",
                                title: "Sorry!",
                                text: data.msg,
                                confirmButtonClass: "btn btn-success",
                                showCancelButton: true,
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, upgrade it!'
                            }).then(function (confirm) {
                                if (confirm.value == true) {
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function () {
                        setTimeout(function () {
                            $('#overlay').fadeOut(300);
                        }, 500);
                    }
                }).done(function () {
                    setTimeout(function () {
                        $('#overlay').fadeOut(300);
                    }, 500);
                });
            }
        }
    });

    $('#GuestURLShortTypes').validate({
        rules: {
            client_website_url_two: {
                required: true
            }
        },
        messages: {
            client_website_url_two: {
                required: "Please enter valid URL.",
            }
        },
        submitHandler: function (form) {
            $.ajax({
                url: $('#GuestURLShortTypes').attr('action'),
                type: "POST",
                data: $('#GuestURLShortTypes').serialize(),
                success: function (data) {
                    if (data.user_status == "registered" && data.status == "success") {
                        $('#GuestURLShortTypes').trigger("reset");
                        Swal.fire({
                            type: "success",
                            title: "Done!",
                            text: data.msg,
                            confirmButtonClass: "btn btn-success"
                        }).then(function (confirm) {
                            if (confirm.value == true) {
                                $('#GuestUserDataModal').modal('show');
                                $('.GuestUserDataForm').hide();
                                $('#client-url-two-error-msg').html("Total links left: " + data.links_left);
                                setTimeout(function () {
                                    $('.GuestUserDataForm .guest-user-form-title').html("Generated Link");
                                    $('#guest-user-link-block').show();
                                    $("#guest-user-link-block,#generated_link").val(data.link);
                                    $('.share-link-block').html(data.share_links);
                                    $("#guest-user-link-block,#generated_link").val(data.link);

                                    $('.GuestUserDataForm,#btn-guest-share-fb').attr('data-generated_link', data.link);
                                    $('.GuestUserDataForm,#btn-guest-share-twitter').attr('data-generated_link', data.link);
                                    $('.GuestUserDataForm,#btn-guest-share-linkedin').attr('data-generated_link', data.link);
                                    $('.GuestUserDataForm,#btn-guest-share-linkedin').attr('data-website_url', $('#client_website_url').val());
                                    $('.GuestUserDataForm,#btn-guest-share-mail').attr('data-generated_link', data.link);
                                }, 300);
                            }
                        });
                    } else if (data.status == "success" && data.user_status == "guest") {
                        $('#GuestUserDataModal').modal('show');
                        $('#GuestUserDataForm,#guest_website_url').val($('#client_website_url_two').val());
                        $('#GuestUserDataForm,#guest_link_type').val($('#link_type').val());
                    } else if (data.status == "link-fail") {
                        Swal.fire({
                            type: "error",
                            title: "Failed!",
                            text: data.msg,
                            showCancelButton: 1,
                        })
                    } else if (data.status == "limit-exhausted") {
                        Swal.fire({
                            type: "warning",
                            title: "Sorry!",
                            text: data.msg,
                            confirmButtonClass: "btn btn-success",
                            showCancelButton: true,
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, upgrade it!'
                        }).then(function (confirm) {
                            if (confirm.value == true) {
                                location.href = "{{route('pricing')}}";
                            }
                        });
                    }
                },
                error: function () {
                    setTimeout(function () {
                        $('#overlay').fadeOut(300);
                    }, 500);
                }
            }).done(function () {
                setTimeout(function () {
                    $('#overlay').fadeOut(300);  
                },500);
            });
        }
    });

    $('#GetQuoteForm').validate({
        rules: {
            fullname: {
                required:true,
            },
            email: {
                required: true,
                Validemail:true
            },
            phone_number: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength:10
            }
        },
        messages: {
            fullname: {
                required:"Please enter your fullname"
            },
            email: {
                required:"Please enter your valid email address"
            },
            phone_number: {
                required:"Please enter your 10 digit phone number."
            }
        },
        submitHandler: function (form) {
            $.ajax({
                url: $('#GetQuoteForm').attr('action'),
                type: "POST",
                data: $('#GetQuoteForm').serialize(),
                success: function (data) {
                    if (data.status == "success") {
                        Swal.fire({
                            type: "success",
                            title: "Done!",
                            text: data.msg,
                            confirmButtonClass: "btn btn-success"
                        }).then(function (confirm) {
                            if (confirm.value == true) {
                                $('#GetQuoteForm').trigger("reset");
                                $('#GetCallModal').modal('hide');
                            }
                        });
                    } else if (data.status == "fail") {
                        Swal.fire({
                            type: "error",
                            title: "Failed!",
                            text: data.msg,
                            confirmButtonClass: "btn btn-success"
                        })
                    }
                },
                error: function () {
                    setTimeout(function () {
                        $('#overlay').fadeOut(300);
                    }, 500);    
                }
            }).done(function () {
                setTimeout(function () {
                    $('#overlay').fadeOut(300);
                }, 500);    
            });
        }
    });

    $('#AddLinkGroupForm').validate({
        rules: {
            group_name: {
                required:true,
            },
            'user_links[]': {
                required:true
            }
        },
        messages: {
            group_name: {
                required: "Please enter group name.",
                'user_links[]': {
                    required:"Please select links to add in the group."
                }
            }
        }
    });

    $('#btn-guest-share-fb').click(function () {
        var short_link = $('#btn-guest-share-fb').attr('data-generated_link');
        var facebookWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + short_link, 'facebook-popup', 'height=350,width=600');
        if (facebookWindow.focus) { facebookWindow.focus(); }
        return false;
    });

    $('#btn-guest-share-twitter').click(function () {
        var short_link = $('#btn-guest-share-twitter').attr('data-generated_link');
        var twitterWindow = window.open('https://twitter.com/intent/tweet?url=' + short_link);
        if (twitterWindow.focus) { twitterWindow.focus(); }
        return false;
    });

    $('#btn-guest-share-linkedin').click(function () {
        var short_link = $('#btn-guest-share-linkedin').attr('data-generated_link');
        var website_url = $('#btn-guest-share-linkedin').attr('data-website_url');
        var linkedinWindow = window.open('https://www.linkedin.com/shareArticle?mini=true&url='+website_url+'&title='+short_link+'&source='+website_url);
        if (linkedinWindow.focus) { linkedinWindow.focus(); }
        return false;
    });

    $('#btn-guest-share-mail').click(function () {
        var short_link = $('#btn-guest-share-mail').attr('data-generated_link');
        var mailWindow = window.open('mailto:?subject=Sharing You Short Link&body=' + short_link);
        if (mailWindow.focus) { mailWindow.focus(); }
        return false;
    });

    $('#btn-guest-link-type-share-fb').click(function () {
        var short_link = $('#btn-guest-link-type-share-fb').attr('data-generated_link');
        var facebookWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + short_link, 'facebook-popup', 'height=350,width=600');
        if (facebookWindow.focus) { facebookWindow.focus(); }
        return false;
    });

    $('#btn-guest-link-type-share-twitter').click(function () {
        var short_link = $('#btn-guest-link-type-share-twitter').attr('data-generated_link');
        var twitterWindow = window.open('https://twitter.com/intent/tweet?url=' + short_link);
        if (twitterWindow.focus) { twitterWindow.focus(); }
        return false;
    });

    $('#btn-guest-link-type-share-linkedin').click(function () {
        var short_link = $('#btn-guest-link-type-share-linkedin').attr('data-generated_link');
        var website_url = $('#btn-guest-link-type-share-linkedin').attr('data-website_url');
        var linkedinWindow = window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + website_url + '&title=' + short_link + '&source=' + website_url);
        if (linkedinWindow.focus) { linkedinWindow.focus(); }
        return false;
    });

    $('#btn-guest-link-type-share-mail').click(function () {
        var short_link = $('#btn-guest-link-type-share-mail').attr('data-generated_link');
        var mailWindow = window.open('mailto:?subject=Sharing You Short Link&body=' + short_link);
        if (mailWindow.focus) { mailWindow.focus(); }
        return false;
    });

});