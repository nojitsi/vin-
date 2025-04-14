const { connect } = require("puppeteer-real-browser");


console.log(0)

function delay(time) {
    return new Promise(resolve => setTimeout(resolve, time));
}


async function test() {
    console.log(1)
    let url = "https://bidfax.info/bmw/330/20727995-bmw-330i-2020-silver-20l-4-vin-3mw5r1j00l8b15589.html"
    const { browser, page } = await connect({
        headless: false,

        args: [],

        customConfig: {},

        turnstile: true,

        connectOption: {},

        disableXvfb: false,
        ignoreAllFlags: false,
        // proxy:{
        //     host:'<proxy-host>',
        //     port:'<proxy-port>',
        //     username:'<proxy-username>',
        //     password:'<proxy-password>'
        // }
    });
    await page.goto(url);
    await delay(80000);

    // Getting the page source HTML
    const pageSourceHTML = await page.content();

    const cookies = await page.cookies()
    // Closing the browser
    await browser.close();

    console.log({pageSourceHTML, cookies}); // Output the page source HTML


    const res = await fetch(url, {
        headers: {
            'Cookies': 'application/json',
        },
    })
        .then(function (response) {
            // status "OK"
        case 200:
            return response.text();
            // status "Not Found"
        case 404:
            throw response;
        })


    console.log({res})
}

test();
