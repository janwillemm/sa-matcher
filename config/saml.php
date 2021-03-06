<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 29/03/16
 * Time: 12:42
 */

$settings = array (
    // If 'strict' is True, then the PHP Toolkit will reject unsigned
    // or unencrypted messages if it expects them signed or encrypted
    // Also will reject the messages if not strictly follow the SAML
    // standard: Destination, NameId, Conditions ... are validated too.
    'strict' => true,

    // Enable debug mode (to print errors)
    'debug' => true,

    // Service Provider Data that we are deploying
    'sp' => array (
        // Identifier of the SP entity  (must be a URI)
        'entityId' => 'https://sa.ewi.tudelft.nl/web/',
        // Specifies info about where and how the <AuthnResponse> message MUST be
        // returned to the requester, in this case our SP.
        'assertionConsumerService' => array (
            // URL Location where the <Response> from the IdP will be returned
            'url' => 'https://sa.ewi.tudelft.nl/web/saml/acs',
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-Redirect binding only
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
        ),
        // Specifies info about where and how the <Logout Response> message MUST be
        // returned to the requester, in this case our SP.
        'singleLogoutService' => array (
            // URL Location where the <Response> from the IdP will be returned
            'url' => 'https://sa.ewi.tudelft.nl/web/saml/logout',
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-Redirect binding only
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
        ),
        // Specifies constraints on the name identifier to be used to
        // represent the requested subject.
        // Take a look on lib/Saml2/Constants.php to see the NameIdFormat supported
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',

        // Usually x509cert and privateKey of the SP are provided by files placed at
        // the certs folder. But we can also provide them with the following parameters
        'x509cert' => 'MIIDbTCCAlWgAwIBAgIJAKucGHSBWlCDMA0GCSqGSIb3DQEBCwUAME0xCzAJBgNV
BAYTAkFVMQswCQYDVQQIDAJOTDEOMAwGA1UEBwwFREVMRlQxITAfBgNVBAoMGElu
dGVybmV0IFdpZGdpdHMgUHR5IEx0ZDAeFw0xNjAyMDMyMDU2NThaFw0yNjAyMDIy
MDU2NThaME0xCzAJBgNVBAYTAkFVMQswCQYDVQQIDAJOTDEOMAwGA1UEBwwFREVM
RlQxITAfBgNVBAoMGEludGVybmV0IFdpZGdpdHMgUHR5IEx0ZDCCASIwDQYJKoZI
hvcNAQEBBQADggEPADCCAQoCggEBANUIIUxGC0cm80KcSG7mORswShLbeJWootO/
ekgxQhMT+MXGWIsNwChwPs4oBgEIth71r2HDefXW4HUA0KKxJuT9VRUvV5DokmMx
BQHqsxkpsSuujsa6MPkFSZQzcEHQb0QZaX304uzH6SHM+JW4uAuKykgGum9XPysq
Ewv2dJyD9x0l8A6zA3KCIwMzja4emklxg6xr54Wh5eieW07NfTflwWkLXqogkfNh
mU+1WcDjQOQyTrhR4juH15q7zzTPrkHpPYlSAuaewZkA2zVp3S/K3HsUgKz/a8WX
3HFrbta40q6llbCn7au54lhpga+w0uDN2GnCGTYoXJBunlf3vLMCAwEAAaNQME4w
HQYDVR0OBBYEFBaCKC6sZhjsgWWXuNnC8bqbSvZlMB8GA1UdIwQYMBaAFBaCKC6s
ZhjsgWWXuNnC8bqbSvZlMAwGA1UdEwQFMAMBAf8wDQYJKoZIhvcNAQELBQADggEB
AJMUQ9wKJ5Mhgq2SeyPNnes1lFFe9IVgwYqfGHENWsZnFICn5B3pjs53l2IUaWmq
vHiOXjN4HmUmYEhjgWeIUZdlauumQLCNsSPAHan9xWSbjVrlgMsUqKS4Tfqg08GZ
5I7RWM9A3haYJMQscfhS9D8ZkYfi4ZZBQqP2xj0vK6rGAZfuUfTG3n6LSLcM4v7T
XyNcEQ37HmdDd+VbaMce2KiO1n0PP9SE1lHJSrkxe1c7Z+wcVZl+fLuVLRSFn0n8
8t8HpPFS0Yjla2C2VBZ/j12o9IsQDkAqTdnRKB0fAlz6lTN+W7wszwRf5CD2anSR
8FoL4+UjzcR5gPSwsuswQy4=',
        'privateKey' => 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDVCCFMRgtHJvNC
nEhu5jkbMEoS23iVqKLTv3pIMUITE/jFxliLDcAocD7OKAYBCLYe9a9hw3n11uB1
ANCisSbk/VUVL1eQ6JJjMQUB6rMZKbErro7GujD5BUmUM3BB0G9EGWl99OLsx+kh
zPiVuLgLispIBrpvVz8rKhML9nScg/cdJfAOswNygiMDM42uHppJcYOsa+eFoeXo
nltOzX035cFpC16qIJHzYZlPtVnA40DkMk64UeI7h9eau880z65B6T2JUgLmnsGZ
ANs1ad0vytx7FICs/2vFl9xxa27WuNKupZWwp+2rueJYaYGvsNLgzdhpwhk2KFyQ
bp5X97yzAgMBAAECggEAD46ib+GFnVKY3Tpwh7jEXtnt7uacLcG88l2/XlpKiv4g
YsETYkREzi80RvXhSl4KfsROZINT+sIQbjr7AYaSYpKljgCBEpIJbrj7tqIfJi1H
RPtgbd7XCLh8IRiIkCXamkyIyawCjmwi+FbxqG1u81jVYOEs6Eik0lAmR+9doLhY
NNpEJTlqBP/NMor5Ccu/iGCEjCrzkutvMRTsrBqr8KTXhjTUsWg7ihdRd3Y/PXiJ
AC5EBOx6ZBlLGIzYfuzRhnpAqe4yaeWPF+WMm7MLlOPsXcP5FocdKdcY9RFHfq5j
6wYo9uaWq/9NUqq+SgjwxxbiWzlbrzhYSwjukzbj0QKBgQD7021FrPsWmgefgiqY
fjP23egjxhXULGr+S/gKrMyOlrmVCI7+ezEO35xaMI0eqcM152xj1247DPlROOJ4
kq9WkCE1oRemod6Cn43YZRKiRmiQYLM+ErCEM/4Tu1TCCdX3dTynJUyY66VlZQkf
90JpcGAs/dbiWbn531qb/woWLQKBgQDYkBaKGfWV2Y7UQSjcHPBzfKaHxCE97tLf
qvqFNhjknDWvegjlyXhk5FVDd1Kp73K2VDbE8cPqwvP72mrGAqhlNiA6LWWrG1oH
RIOQ0JK/rPet5fE1NCH9csbi6Yhc/xC32HunWMedyRFQqcWITFEpyQZbnBMRmf7w
lCDeEuLKXwKBgB/5MzmSgfrXqbod68ya0Xw5ppzMLL9YuGj7Ok4YrIw6JOwAPy+e
cpch2xc0bOaExW1VqdRvaOaEei9O2qpWbX6/JAhMINWeXcMWAQuFob0K1YHnVTq/
YrwWYd8dfOB6ITmfIAlU2gnceY6LKoJtgXgjtYJg5GSu4ccRDc8arawtAoGAeHJb
NuANSRTBbaf388Rcr76qWGRrIKkNu7y6rRBTdAK1kS1MeZE+Vs7v5SAeZ8l3gZUB
CTR2BMH9NRxbulmMEw6xienp2+rQfa5LhmWa2OR4tM1pBHBEX1RQ7a95Wk+6mqXa
0E5+Z3GHIdfqt03K7nSSBq2dpXKC6odYaGsUm/0CgYEA0/7ozecyNLigIGTmVs1I
kPBG36rQ0xbZOPMljXosF6NbifxEpBXYoubfmANEhSeCi4og4qAjavSaKn4R/ndC
KQFEaaS+43Wz/+YjU+QVbvGqENHuBjnYohtWT9sTN5jWUJIYr7CHvlL0MxoTysAT
KQZfFsxSpv3d4DLNa0kBtE0=',
    ),

    // Identity Provider Data that we want connect with our SP
    'idp' => array (
        // Identifier of the IdP entity  (must be a URI)
        'entityId' => 'https://gatekeeper2.tudelft.nl/openaselect/profiles/saml2/',
        // SSO endpoint info of the IdP. (Authentication Request protocol)
        'singleSignOnService' => array (
            // URL Target of the IdP where the SP will send the Authentication Request Message
            'url' => 'https://gatekeeper2.tudelft.nl/openaselect/profiles/saml2/sso/web',
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-POST binding only
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
        ),
        // SLO endpoint info of the IdP.
        'singleLogoutService' => array (
            // URL Location of the IdP where the SP will send the SLO Request
            'url' => 'https://gatekeeper2.tudelft.nl/openaselect/profiles/saml2/sso/logout',
            // SAML protocol binding to be used when returning the <Response>
            // message.  Onelogin Toolkit supports for this endpoint the
            // HTTP-Redirect binding only
            'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
        ),
        // Public x509 certificate of the IdP
        'x509cert' => 'MIIDhzCCAm+gAwIBAgIEfRjvpzANBgkqhkiG9w0BAQsFADB0MQswCQYDVQQGEwJOTDEVMBMGA1UE
CBMMWnVpZC1Ib2xsYW5kMQ4wDAYDVQQHEwVEZWxmdDERMA8GA1UEChMIVFUgRGVsZnQxEDAOBgNV
BAsTB1NTQy1JQ1QxGTAXBgNVBAMTEHR1ZGFzZWxlY3RzaWduZWQwHhcNMTYwMjAxMTAyMjQ0WhcN
MjYwMTI5MTAyMjQ0WjB0MQswCQYDVQQGEwJOTDEVMBMGA1UECBMMWnVpZC1Ib2xsYW5kMQ4wDAYD
VQQHEwVEZWxmdDERMA8GA1UEChMIVFUgRGVsZnQxEDAOBgNVBAsTB1NTQy1JQ1QxGTAXBgNVBAMT
EHR1ZGFzZWxlY3RzaWduZWQwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDBT4QL8BWh
dKIpNQFFfwk9T9/5z+sI8MLvxUuIkdpi+LOxvrPqhfM80FNaYGOY+LUOCHe9YW3Xez9MY1k2rcT8
J3YAyosXgKoha5lbGf59ZMdjA9+KciJdIQ9O2+NF5xai72OCuTsfPN1RZT8JqP8WtoHAKsrMXZbX
toE7XVTGXYvwE2aU25tW9JiDb3ZEvJibmGHKS7EDL5uau0DmTYoNQZE76jErdPl3idSNBuk5PBnJ
4hV1NqWfAiDYb1oVkpQath2zBVSUoMNhNis3bmQdCFHzruVrX8ClhGEPurnxtxGgTbudmbXM4CF3
w1izasUJCAq/vNvM65rQ7p5qL8hVAgMBAAGjITAfMB0GA1UdDgQWBBSUqH9CcXmKnfNLTCaUksq2
Qg2agzANBgkqhkiG9w0BAQsFAAOCAQEATTh4nDSYAiU0TEl6DNCis9BH99lBLaIg2rciYawQKgQZ
aPhwCtBxOPy56fMcJc/cg34UiUkKtiIdmwilLBim3aZlVNKOKpZOm54B7IXxxM0VflRWvG6r5d/e
33mZmmSFMMwK7duKF8W5tyNA56wznczNkTV9H6xOdYJO0lc2Pq7Vs+zJx7pb7YEz0ibwrTofM5eP
koKMMApW7xlZxgWr0Cw+q/+hN5m3uTa1MT478FJ2cy7aEJRRIRl7VwRidD4Fodd4HZx+zlbfKOk6
+9KazDUS7qIoqx3QsCn1CmOG2ymoTEMD6I4fSiiOCLmBvk7meTrYuyyI+W11s1W41hNPqg==',
        /*
         *  Instead of use the whole x509cert you can use a fingerprint
         *  (openssl x509 -noout -fingerprint -in "idp.crt" to generate it,
         *   or add for example the -sha256 , -sha384 or -sha512 parameter)
         *
         *  If a fingerprint is provided, then the certFingerprintAlgorithm is required in order to
         *  let the toolkit know which Algorithm was used. Possible values: sha1, sha256, sha384 or sha512
         *  'sha1' is the default value.
         */
        // 'certFingerprint' => '',
        // 'certFingerprintAlgorithm' => 'sha1',
    ),
    'contactPerson' => array (
        'technical' => array (
            'givenName' => 'Jan-Willem Manenschijn',
            'emailAddress' => 'J.W.Manenschijn@student.tudelft.nl'
        ),
    ),
    'security' => array (
        // Indicates that the nameID of the <samlp:logoutRequest> sent by this SP
        // will be encrypted.
        'nameIdEncrypted' => false,
        // Indicates whether the <samlp:AuthnRequest> messages sent by this SP
        // will be signed.  [Metadata of the SP will offer this info]
        'authnRequestsSigned' => true,

        // Indicates whether the <samlp:logoutRequest> messages sent by this SP
        // will be signed.
        'logoutRequestSigned' => true,

        // Indicates whether the <samlp:logoutResponse> messages sent by this SP
        // will be signed.
        'logoutResponseSigned' => true,

        /** signatures and encryptions required **/

        // Indicates a requirement for the <samlp:Response>, <samlp:LogoutRequest>
        // and <samlp:LogoutResponse> elements received by this SP to be signed.
        'wantMessagesSigned' => true,

        // Indicates a requirement for the <saml:Assertion> elements received by
        // this SP to be signed. [Metadata of the SP will offer this info]
        'wantAssertionsSigned' => true,

        // Indicates a requirement for the NameID received by
        // this SP to be encrypted.
        'wantNameIdEncrypted' => false,

        'signatureAlgorithm' => 'http://www.w3.org/2000/09/xmldsig#rsa-sha1',
    ),
);