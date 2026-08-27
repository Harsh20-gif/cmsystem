const puppeteer = require('puppeteer');
(async () => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    await page.goto('http://127.0.0.1:8000');
    console.log('Opened page');
    await page.waitForTimeout(1000);
    const html = await page.$eval('#enrollModalOverlay', el => el.innerHTML);
    console.log('INNER HTML OF OVERLAY:');
    console.log(html);
    const bounds = await page.$eval('#enrollModalOverlay .modal-card', el => {
        const b = el.getBoundingClientRect();
        return `${b.width}x${b.height} at ${b.x},${b.y}`;
    });
    console.log('MODAL CARD BOUNDS:', bounds);
    const css = await page.$eval('#enrollModalOverlay .modal-card', el => {
        const s = window.getComputedStyle(el);
        return `display: ${s.display}, opacity: ${s.opacity}, visibility: ${s.visibility}, zIndex: ${s.zIndex}`;
    });
    console.log('MODAL CARD DISPLAY:', css);
    await browser.close();
})();
