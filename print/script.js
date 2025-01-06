


const service_type = document.getElementsByClassName('service_type');
const printBtn = document.getElementsByClassName('btn-print');
const fullName = document.getElementsByClassName('full-name');
const purposeJs = document.getElementsByClassName('purposeJs');
const address = document.getElementsByClassName('loc-address');


const lname = document.getElementsByClassName('lname-js');
const fname = document.getElementsByClassName('fname-js');
const mname = document.getElementsByClassName('mname-js');
const bday = document.getElementsByClassName('bday-js');
const cStatus = document.getElementsByClassName('cStatus-js');
const gender = document.getElementsByClassName('gender-js');
const contact = document.getElementsByClassName('contact-js');
const vStatus = document.getElementsByClassName('vStatus-js');
const occupation = document.getElementsByClassName('occupation-js');
const sv_id = document.getElementsByClassName("sv_id");
const sv_name = document.getElementsByClassName("sv_name");
const svr_transaction_id = document.getElementsByClassName("svr_transaction_id");


//Current Date
let currentDate = new Date(); // Assuming currentDate is defined
let year = currentDate.getFullYear();
let months = [
  'January', 'February', 'March', 'April', 'May', 'June',
  'July', 'August', 'September', 'October', 'November', 'December'
];
let monthIndex = currentDate.getMonth();
let monthName = months[monthIndex];

// let month = String(currentDate.getMonth() + 1).padStart(2, '0');
let day = String(currentDate.getDate()).padStart(2, '0');

const jsonValue = document.querySelector('.council').value;

const councilArray = JSON.parse(jsonValue);
const chairmanName = document.querySelector(".chairman").value;
const skChairman = document.querySelector(".skChairman").value;
const secName = document.querySelector(".secretary").value;
const trName = document.querySelector(".treasurer").value;

console.log(trName);

for(let i=0; i<printBtn.length; i++)
{
    // Sample input date string
    let dateString = bday[i].value; // Assuming the format is 'YYYY-MM-DD'

    // Split the date string into year, month, and day parts
    let parts = dateString.split('-');
    let bDayYear = parts[0];
    let bMonthIndex = parseInt(parts[1]) - 1; // Months are zero-indexed in JavaScript
    let bDayDay = parts[2];

    // Array of month names
    let bMonths = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    // Get the month name based on the month index
    let bMonthName = bMonths[bMonthIndex];

    // Construct the formatted date string
    let formattedDate = `${bMonthName}, ${bDayDay}. ${bDayYear}`;

    const purpose = document.querySelectorAll(".purpose-js");
    printBtn[i].addEventListener("click", function(){
        let myWindow = window.open("", "");
        let doc = myWindow.document;
        doc.open();
        doc.write("<html>");
        doc.write("<head>");
        doc.write(`<title>Print Report</title>`);
        
        if(sv_id[i].value == 3)
        {
            doc.write(`
            <style>
                @page{
                    size: A4;
                    margin-top: 100px;
                }
                
                body{
                    height: 100vh;
                    margin: 0;
                    page-break-after: always;
                    font-family: 'Times New Roman', Times, serif;
                }
                
                
                .center{
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100%;
                }
                
                .container
                {
                    padding: 20px 15px;
                    max-width: 600px;
                    width: 100%;
                }
                
                .container .header{
                    line-height: 25px;
                    text-align: center;
                    display: flex;
                    justify-content: space-between;
                    border-bottom: 1px solid gray;
                }
                
                .container .header h1
                {
                    font-size: 24px;
                    margin-top: 20px;
                    margin-bottom: 20px;
                
                }
                
                .container .letter-con .text span
                {
                    margin-left: 50px;
                }
                
                .container .letter-con .from
                {
                    margin-bottom: 30px;
                }
                
                .container .letter-con .text{
                    line-height: 25px;
                    margin-bottom: 20px;
                }
                
                .container .letter-con .seal-con
                {
                    line-height: 25px;
                }
                
                .container .signature-con
                {
                    margin-top: 40px;
                    display: flex;
                    justify-content: space-between;
                }
                
                .container .signature-con div
                {
                    text-align: center;
                }
                
                .issued-con
                {
                    margin-top: 40px;
                    line-height: 40px;
                }
                
                .signature-con .issued-con
                {
                    display: flex;
                    justify-content: space-around;
                    flex-wrap: wrap;
                }
                
                    @media print {
                        body {
                            height: auto;
                        }
                
                        .center {
                            display: block;
                            margin: 0 70px;
                        }
                
                        .container {
                            margin: 0 auto;
                            box-shadow: none;
                        }
                    }
                
                    .container .header .logo-div{
                        width: 60px;
                        height: 60px;
                    }
                
                    .container .header .logo-div img{
                        width: 100%;
                        height: 100%;
                    }
                
                    .div-table{
                        display: flex;
                        justify-content: space-between;
                    }
                
                    .div-table .details-con
                    {
                        width: 65%;
                        margin-top: 25px;
                    }
                
                    .div-table .flex-con{
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 5px;
                        font-size: 14px;
                        
                    }
                
                    .div-table .space{
                        margin-top: 25px;
                    }
                
                    .div-table .img-con{
                        height: 144px;
                        width: 144px;
                        border: 1px solid black;
                        margin-top: 25px;
                    }
                    </style>
            `);
        }else {
            doc.write(`
            <style>
            @page{
                size: A4;
                margin-top: 100px;
            }
        
            body{
                height: 100vh;
                margin: 0;
                page-break-after: always;
                font-family: 'Times New Roman', Times, serif;
            }
        
        
            .center{
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
                margin-top: 20px;
            }
        
            .container
            {
                padding: 20px 15px;
                max-width: 600px;
                width: 100%;
            }
        
            .container .header{
                line-height: 25px;
                text-align: center;
                display: flex;
                justify-content: space-between;
                border-bottom: 1px solid gray;
            }
        
            .container .header h1
            {
                font-size: 24px;
                margin-top: 20px;
                margin-bottom: 20px;
        
            }
        
            .container .letter-con .text span
            {
                margin-left: 50px;
            }
        
            .container .letter-con .from
            {
                margin-bottom: 30px;
            }
        
            .container .letter-con .text{
                line-height: 25px;
                margin-bottom: 20px;
            }
        
            .container .letter-con .seal-con
            {
                line-height: 25px;
            }
        
            .container .signature-con
            {
                margin-top: 40px;
                display: flex;
                justify-content: space-between;
            }
        
            .container .signature-con div
            {
                text-align: center;
            }
        
            .issued-con
            {
                margin-top: 40px;
                line-height: 40px;
            }
        
            .signature-con .issued-con
            {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
            }
        
            .container .header .logo-div{
                width: 100px;
                height: 100px;
            }
        
            .container .header .logo-div img{
                width: 100%;
                height: 100%;
            }
        
            .div-table .img-con{
                height: 144px;
                width: 144px;
                border: 1px solid black;
                margin-top: 25px;
            }
        
            .div-table .flex{
                display: flex;
                justify-content: flex-end;
                margin-bottom: 40px;
            }
        
            .div-table{
                display: grid;
                grid-template-columns: 250px 1fr;
                margin-top: 30px;
            }
        
            .div-table .left-col{
                display: flex;
                flex-direction: column;
                gap: 15px;
                border-right: 1px solid lightgray;
                margin-right: 30px;
                font-size: 14px;
            }
        
            .left-col span
            {
                display: block;
            }
        
            .certify-div span
            {
                margin-left: 20px;
            }
        
            .content-div{
                line-height: 25px;
            }
            .right-col .details{ 
                margin: 20px 0;
            }
        
            .issued{
                display: flex;
                justify-content: space-between;
                align-items: start;
                font-size: 10px;
                white-space: nowrap;
            }
            .issued strong{
                border-top: 1px solid black;
                padding-top: 5px;
            }
            .issued div{
                margin-right: 30px;
            }
        
            @media print {
                body {
                    height: auto;
                }
        
                .center {
                    display: block;
                }
        
                .container {
                    margin: 0 auto;
                    box-shadow: none;
                }
            }

            .left-col .chairman{
                text-align: center;
            }
        
            </style>
            `)
        }
        //content
        doc.write('</head>');
        doc.write(`<body>`);

        if(sv_id[i].value == 3){
            doc.write(`
            <div class="center">
        <div class="container">
            <div class="header">
                <div class="logo-div">
                    <img src="../../../assets/logo.jpeg" alt="">
                </div>
                <div>
                    <div>Republic of the Philippines</div>
                    <div><strong>Barangay San Manuel San Jose Del Monte Bulacan</strong></div>

                    <h1>BARANGAY ID</h1>
                </div>
                <div class="logo-div">
                    <img src="../../../assets/logo2.png" alt="">
                </div>
            </div>
            <div class="div-table">
                <div class="details-con">
                    <div class="flex-con">
                        <div><strong>LAST NAME</strong></div>
                        <div><strong>FIRST NAME</strong></div>
                        <div><strong>MI</strong></div>
                    </div>
                    <div class="flex-con">
                        <div>${lname[i].value}</div>
                        <div>${fname[i].value}</div>
                        <div>${mname[i].value}</div>
                    </div>
                    <div class="flex-con space">
                        <div><strong>DATE OF BIRTH</strong></div>
                        <div><strong>STATUS</strong></div>
                        <div><strong>GENDER</strong></div>
                    </div>
                    <div class="flex-con">
                        <div>${bday[i].value}</div>
                        <div>${cStatus[i].value}</div>
                        <div>${gender[i].value}</div>
                    </div>

                    <div class="flex-con space">
                        <div><strong>CONTACT NO.</strong></div>
                        <div><strong>VOTER STATUS</strong></div>
                        <div><strong>OCCUPATION</strong></div>
                    </div>
                    <div class="flex-con">
                        <div>${contact[i].value}</div>
                        <div>${vStatus[i].value}</div>
                        <div>${occupation[i].value}</div>
                    </div>

                    <div class="flex-con space">
                        <div><strong>ADDRESS</strong></div>
                    </div>
                    <div class="flex-con">
                        <div>${address[i].value}</div>
                    </div>
                </div>
                <div class="img-con">

                </div>
            </div>
        </div>
    </div>
            `)
        }else{
            doc.write(`
            <div class="center">
            <div class="container">
                <div class="header">
                    <div class="logo-div">
                        <img src="../../../assets/logo.jpeg" alt="">
                    </div>
                    <div>
                        <div>Republic of the Philippines</div>
                        <div>Province of Bulacan</div>
                        <div>City of San Jose </div>
                        <div><strong>Barangay San Manuel</strong></div>
    
                        <h1>${sv_name[i].value}</h1>
                    </div>
                    <div class="logo-div">
                        <img src="../../../assets/logo2.png" alt="">
                    </div>
                </div>
                <div class="div-table">
                    <div class="left-col">
                        <div class="chairman">
                        <strong>${chairmanName}</strong><span class="chairman-span">Chairman</span>
                        </div>
                        <div><strong>BARANGAY COUNCIL:</strong></div>
                        <div>Hon. ${councilArray[0]}</div>
                        <div>Hon. ${councilArray[1]}</div>
                        <div>Hon. ${councilArray[2]}</div>
                        <div>Hon. ${councilArray[3]}</div>
                        <div>Hon. ${councilArray[4]}</div>
                        <div>Hon. ${councilArray[5]}</div>
                        <div>Hon. ${councilArray[6]}</div>
                        <div>Hon.  ${skChairman}<span>SK Chairman</span></div>
                        <div>${secName}<span>Secretary</span></div>
                        <div>${trName}<span>Treasurer</span></div>
    
                        <div class="contact-num">
                            <div>044-769-4279</div>
                            <div>0997-604-5329</div>
                            <div>0950-249-7834</div>
                        </div>
    
                        <div class="email-add">
                            <div>Email Address:</div>
                            <a href="">brgy.sanmanuel1991@gmail.com</a>
                        </div>
                    </div>
    
                    <div class="right-col">
                        <div class="flex">
                            <div class="img-con">
                            
                            </div>
                        </div>
                        <div class="content-div">
                            <div>TO WHOM IT MAY CONCERN:</div>
                            <div class="certify-div">
                                <span>This</span> to certify that <strong>${fullName[i].value}</strong> is currently residing at <strong>${address[i].value}</strong>,
                                Brgy. San Manuel, San Jose Del Monte Bulacan is a bonafide resident of this
                                barangay.
                            </div>
    
                            <div class="details">
                                <div>Birthday: <strong>${formattedDate}</strong></div>
                                <div>Civil Status: <strong>${cStatus[i].value}</strong></div>
                            </div>
                            
                            <div>
                                This certification is issued upon request of the above-named person for 
                                ${purpose[i].value}.
                            </div>
    
                            <div style="margin: 20px 0 60px;">
                                Issued this <u><strong>${monthName}, ${day} ${year}</strong></u> at <u><strong>Barangay San Manuel, City of San Jose Del Monte, Bulacan</strong></u>, Philippines
                            </div>
    
                            <div class="issued">
                            <div>
                                <div>Issued at: CSJDM., Bulacan</div>
                                <div>Issued on: ${monthName}, ${day} ${year} </div>
                                <div>Control No: ${monthName}, ${day} ${year}-${svr_transaction_id[i].value}</div>
                            </div>
                            <div>
                                <strong>Hon. ${chairmanName}</strong>
                                <div>Barangay Chairman</div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            `);
        }
        
        doc.write('</body>');
        doc.write('</html>');
    
        setTimeout(function () {
            myWindow.focus();
            myWindow.print();
            myWindow.close();
        }, 1000);
    });
}
