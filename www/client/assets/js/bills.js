document.addEventListener("DOMContentLoaded", () => {
 
    html2pdf()
    .from(document.getElementById("bill"))
    .set({
        margin: 10,
        filename: 'Facture.pdf',
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    })
    .save();
});