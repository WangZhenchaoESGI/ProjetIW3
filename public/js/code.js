var a;
var googleUser = {};
var Google = function() {
    gapi.load('auth2', function(){
        // Retrieve the singleton for the GoogleAuth library and set up the client.
        auth2 = gapi.auth2.init({
            client_id: '1017629630695-9ev0e7iiln3rqt3aiiomnt4pies0l7nr.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin',
            // Request scopes in addition to 'profile' and 'email'
            //scope: 'additional_scope'
        });
        attachSignin(document.getElementById('customBtn'));
    });
};

function attachSignin(element) {
    //console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {
            googleSignOut();
            //console.log("/facebook_verify_connexion?name="+googleUser.getBasicProfile().getName()+"&email="+googleUser.getBasicProfile().getEmail());
            window.location.href="/google_verify_connexion?lastname="+googleUser.getBasicProfile().getGivenName()+"&firstname="+googleUser.getBasicProfile().getFamilyName()+"&email="+googleUser.getBasicProfile().getEmail();
        }, function(error) {
            //alert(JSON.stringify(error, undefined, 2));
        });
}

function googleSignOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        console.log('User signed out.');
    });
}
