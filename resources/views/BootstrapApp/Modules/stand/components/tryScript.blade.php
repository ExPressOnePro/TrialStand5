<script>
    // Function to make an AJAX request and populate the table
    function fetchData() {
        const url = '{{route('stand.table_json', $StandTemplate->id)}}';
        const xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                displayTable(response.data[0]);
            }
        };

        xhr.open('GET', url, true);
        xhr.send();
    }

    // Function to display the table
    function displayTable(data) {
        const dayRowsDiv = document.getElementById('dayRows');

        for (const key in data.week_schedule) {
            const colDiv = document.createElement('div');
            colDiv.classList.add('col-sm-12', 'col-md-6', 'col-lg-4', 'mb-5', 'mb-lg-5');

            const cardDiv = document.createElement('div');
            cardDiv.classList.add('card', 'card-header', 'card-header-content-between', 'rounded', 'text-center');
            cardDiv.style.background = '#749FBA';

            const pElement = document.createElement('p');
            pElement.classList.add('card-header-title', 'h5', 'dd', 'day-cell');
            pElement.textContent = key;

            cardDiv.appendChild(pElement);

            // Add time columns
            for (const time of data.week_schedule[key]) {
                const timeColDiv = document.createElement('div');
                timeColDiv.classList.add('col-sm-12', 'mt-1', 'time-cell');

                const timeCardDiv = document.createElement('a');
                timeCardDiv.classList.add('card', 'rounded-3', 'text-decoration-none', 'shadow');

                const dFlexDiv = document.createElement('div');
                dFlexDiv.classList.add('d-flex', 'align-items-center');

                // Time column
                const timeCol = document.createElement('div');
                timeCol.classList.add('col-3', 'text-center');
                const timeParagraph = document.createElement('p');
                timeParagraph.classList.add('h5');
                timeParagraph.innerHTML = `<strong>${time}</strong>`;
                timeCol.appendChild(timeParagraph);

                // Check if there is data in standpublishers for the current day and time
                const publisherData = getPublisherData(data.stand_publishers, key, time);

                // Rest of the columns
                const colDivider = document.createElement('div');
                colDivider.classList.add('col', 'ms-0', 'd-flex');
                const vrDiv = document.createElement('div');
                vrDiv.classList.add('vr');
                colDivider.appendChild(vrDiv);

                const colContent = document.createElement('div');
                colContent.classList.add('col-8');

                if (publisherData) {
                    // Display publisher info
                    const publisherInfo = document.createElement('div');
                    publisherInfo.classList.add('publisher-info');
                    publisherInfo.textContent = `Publisher: ${publisherData.publisher}, Info: ${publisherData.info}`;
                    colContent.appendChild(publisherInfo);
                }

                const mtDiv = document.createElement('div');
                mtDiv.classList.add('mt-1', 'mb-0');
                colContent.appendChild(mtDiv);

                dFlexDiv.appendChild(timeCol);
                dFlexDiv.appendChild(colDivider);
                dFlexDiv.appendChild(colContent);

                timeCardDiv.appendChild(dFlexDiv);
                timeColDiv.appendChild(timeCardDiv);
                colDiv.appendChild(timeColDiv);
            }

            dayRowsDiv.appendChild(colDiv);
        }
    }

    // Function to get publisher data for the current day and time
    function getPublisherData(standPublishers, day, time) {
        return standPublishers.find(item => item.day === day && item.time === time);
    }

    // Fetch data when the page loads
    window.onload = function () {
        fetchData();
    };
</script>
