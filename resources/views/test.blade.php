<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script type="text/javascript" src="https://unpkg.com/mollitia"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <script>
    const Mollitia = window.Mollitia;  

    const myRetry = new Mollitia.Retry({
        attempts: 3, // Will retry two times
        interval: 1000, // Will wait 500ms between attempts
        onRejection: (err, attempt) => { 
            console.info('er.................r')
        }
    });

    const myRatelimit = new Mollitia.Ratelimit({
      limitPeriod: 10000,
      limitForPeriod: 3
    });

    const ratelimit2 = new Mollitia.Ratelimit({
      limitPeriod: 2000,
      limitForPeriod: 1,
    });

    const myFunction = (msg) => {


      // return axios.get('http://localhost:8000/api/users')
      //     .then((response) =>  console.info(response))
      //     .catch((error) => console.log('error.........'));

  

      return new Promise((resolve) => {
        setTimeout(() => {

          console.info(msg);
          resolve();
        }, 100);
      });
    };
    const myCircuit = new Mollitia.Circuit({
      func: myFunction,
      options: {
        modules: [
          // ratelimit2,
          myRatelimit,
          //myRetry
        ]
      }
    });

    (async () => {
      let nbSuccess = 0;
      let nbErrors = 0;


      for (let i = 0; i < 10; i++) {
        
        try {
          await myCircuit.fn(myFunction).execute('my super message');
          nbSuccess++;

        } catch {
          nbErrors++;

        }
      }
      console.info(`Should have nbSuccess = 3 and nbSuccess = ${nbSuccess}`);
      console.info(`Should have nbErrors = 7 and nbErrors = ${nbErrors}`);
    })();
  </script>
</head>
<body>
  
</body>
</html>
