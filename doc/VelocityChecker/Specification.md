Functional specification
We have got a login mechanism, but we need an anti-bruteforce detection system. Everybody said
that captcha is a good thing, and yes it is, but i don’t want to make the user’s life harder more then it
is needed. I want to give them captcha only when it’s necessary.
We want to use the captcha in these cases:

     from one ip we have 3 failed login attempt
     from an ip range (192.168.0.x) we have 500 failed login attempt
     from an ip country we have 1000 failed login attempt
     with a username we have 3 failed login attempt
     If the username registration country is different from the ip country and the login is failed then you
    must increase the ip counter to the captcha limit (so you need to activate the captcha at the next try,
    so the ip gets "blocked").

If we have a failed login we must increase the ip, the ip range, the country and the username counter
till the captcha is not active.

After that (if the captcha is active) we should increase ONLY the ip counter.


The counters have a 3600 sec TTL, with the following description:
The counter logs the failed logins continuously and we count for the last one hour. It is allowed to
summarize the counts in 300 seconds blocks.

Additional information
 you don't need to implement the ip range calculator
 you don't need to implement the geoip
 you don't need to implement a login function
 you don't need to implement a controller with view (no frontend needed!)

Classes to implement

 UserData - ok
 LoginData -ok
 Logger -ok
 LoginChecker -
