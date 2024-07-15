import puppeteer from 'puppeteer';
import { config } from 'dotenv';

(async () => {
    try {

        config(); // Load environment variables
        console.log(process.env.APP_ENV);
        // Conditionally set executablePath for Production environment
        if (process.env.APP_ENV === 'Production') {

            var baseurl = 'https://naghi.sohoby.com'; // Replace with your Laravel base URL
            console.log(baseurl);

            var browser = await puppeteer.launch({
                headless: true,
                // Increase protocolTimeout to 120 seconds (120000 milliseconds)
                timeout: 120000,
                executablePath: '/usr/bin/chromium-browser', // Path to the Chromium executable
                args: ['--no-sandbox', '--disable-setuid-sandbox'] // Additional args for Linux deployment
            });
        }else{

            var baseurl = "http://127.0.0.1:8000"; // Replace with your Laravel base URL
            console.log(baseurl);

            var browser = await puppeteer.launch({
                headless: true,
                // Increase protocolTimeout to 120 seconds (120000 milliseconds)
                timeout: 120000,
                //executablePath: '/usr/bin/chromium-browser', // Path to the Chromium executable
                args: ['--no-sandbox', '--disable-setuid-sandbox'] // Additional args for Linux deployment
            });

        }


        const page = await browser.newPage();


        // Set the viewport width to a large number to ensure full content width
        // await page.setViewport({ width: 1920, height: 1080 });

        console.log('Navigating to page...');
        const response = await page.goto(`${baseurl}/sale-graph-pdf?chk=daily`, {
            waitUntil: 'networkidle0', // Wait until there are no more network connections
            timeout: 0 // Set timeout to 0 to disable it
        });

        if (!response || !response.ok()) {
            throw new Error(`Failed to load page. Status: ${response ? response.status() : 'Unknown'}`);
        }

        console.log('Page navigation complete.');


        // Ensure that CSS is fully loaded
        setTimeout(function(){
       },2000);


        // Add CSS files
        const cssFiles = [
            "public/login_asset/assets/css/style.bundle.css",
            "public/login_asset/assets/plugins/global/plugins.bundle.css"
        ];

        for (const file of cssFiles) {
            await page.addStyleTag({ path: file });
        }

        console.log('CSS files added.');

        // Generate current date
        const currentDate = new Date();
        const formattedDate = currentDate.toISOString().split('T')[0]; // Format: YYYY-MM-DD


        console.log('Generating PDF...');
        const pdfOptions = {
            //path: 'storage/app/salegraph/chart(2).pdf',
            path: `storage/app/public/pdf_graph/daily/${formattedDate}-sale-graph.pdf`,
            format: 'A4',
            landscape: false,
            timeout: 0, // Set timeout to 0 to disable it
            margin: {
                // top: '0.5cm',
                right: '0.5cm',
                bottom: '0.5cm',
                // left: '0.5cm'
            }
        };
        await page.pdf(pdfOptions);

        console.log('PDF generation complete.');

        await browser.close();
    } catch (error) {
        console.error('Error generating PDF:', error);
        process.exit(1); // Exit with a non-zero status code to indicate an error
    }
})();
