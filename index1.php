<html>
    <head>
        <style>
            #formatBtn, #send{
                margin: 30px 0;
                display: block;
            }
            .resultText-wrapper{
                max-width: 500px;
                margin: 0px auto;
                background-color: #000;
                color: #fff;
                padding: 50px;
            }
        </style>
    </head>
    <body>
        <center>
        <h1>Daily Updates</h1>
        <textarea id="textareaInput" cols="100" rows="10"></textarea>
        
        <button id="formatBtn">Format</button>
        </center>
        <div class="resultText-wrapper">
            <pre id="resultText"></pre>
        </div>
        <center>
        <form action="./updates.php" method="post">
        <textarea  id="hiddenTextarea" name="hiddenTextarea" hidden></textarea>
        <button id="send" type="submit">Send</button>
        </form>
        </center>
        <script>
        // Get the button element
        var button = document.getElementById('formatBtn');

        // Add an event listener to the button
        button.addEventListener('click', formatter);

        function formatter(){
                const inputText = document.getElementById('textareaInput').value;
                console.log(inputText)
                // Extract date, time, author, and updates using regular expressions
                const regex = /\[(.*?)\] (.*?): Update: ([0-9-/]+)/g;
                let match;
                const updates = [];
                let updatedate;
                while ((match = regex.exec(inputText)) !== null) {
                const date = match[1];
                const time = match[2];
                updatedate = match[1]
                const datepattern = /\b(\d{2})\/(\d{2})\/(\d{4})\b/;
                const match2 = updatedate.match(datepattern);
                updatedate = match2[0];


                const author = match[3];
                const updateStartIndex = match.index + match[0].length + 1;
                const updateEndIndex =
                    inputText.indexOf("[", updateStartIndex) !== -1
                    ? inputText.indexOf("[", updateStartIndex)
                    : inputText.length;
                const update = inputText.substring(updateStartIndex, updateEndIndex).trim();

                updates.push({ date, time, author, update });
                }

                // Format the updates
                let formattedText = "";
                for (const update of updates) {
                formattedText += `${update.time}:\n${update.update}\n\n`;
                }
                console.log(formattedText);
                if(formattedText !==""){
                    let str = "========================\nTeam Update : "+ updatedate +"\n========================\n\n"+ formattedText+"\n========================";
                    document.getElementById('resultText').innerHTML = str;
                    document.getElementById('hiddenTextarea').value = str;
                }
        }
        </script>
    </body>
</html>