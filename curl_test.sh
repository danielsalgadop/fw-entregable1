printf '2 - 3 = ';curl -d "param1=2&param2=3" -X POST 127.0.0.1:8000/substract/
echo
printf '1 + 2 = '
curl 127.0.0.1:8000/add/1/2/
echo
printf '2 * 33 (via GET) = '
curl 127.0.0.1:8000/times/2/?param2=33  -X GET
echo
printf '2 * 4 (via POST) = '
curl 127.0.0.1:8000/times/2/?param2=4 -X POST
echo
printf '4 / 2 = '
curl 127.0.0.1:8000/divide/4/2/
echo