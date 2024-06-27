import puppeteer from 'puppeteer';

(async () => {
    try {
        const browser = await puppeteer.launch({ headless: true });
        const page = await browser.newPage();
        await page.goto('http://hyundi.local/chart', { waitUntil: 'networkidle2' });

        await page.pdf({ path: 'chart(2).pdf', format: 'A4', landscape: true });

        await browser.close();
    } catch (error) {
        console.error('Error generating PDF:', error);
        process.exit(1);  // Exit with a non-zero status code to indicate an error
    }
})();
