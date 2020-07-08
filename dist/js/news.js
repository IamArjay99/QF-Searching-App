document.addEventListener("DOMContentLoaded", function () {
    const news = () => {
        $("#row").html(
            `<img src='../dist/img/loader.gif' style='display: block; margin: 100px auto 0 auto; width: 100px; height: auto'>`
        );
        fetch(
            "http://newsapi.org/v2/top-headlines?country=ph&category=health&apiKey=f13e5753e4b042769b5e895f80a3b794"
        )
            .then((response) => response.json())
            .then((data) => {
                let html = "";
                const title = data.articles.map((item) => item.title);
                for (var i in data.articles) {
                    html += "<div class='news-content'>";
                    html += "<div class='news-body'>";
                    html += "<figure>";
                    html += `<img src=`;
                    html += data.articles[i].urlToImage
                        ? "'" + data.articles[i].urlToImage + "'"
                        : "'../dist/img/error.png' style='border-radius: 50%'";
                    html += `alt='Something went wrong..'>`;
                    html += "<figcaption>";
                    html += `${data.articles[i].title}`;
                    html += "</figcaption>";
                    html += "</figure>";
                    html += "</div>";
                    html += "<div class='news-footer'>";
                    html += "<div class='news-description'>";
                    html += `${
                        data.articles[i].content
                            ? data.articles[i].content.replace(
                                  /\[[+]\d+ chars\]/g,
                                  ""
                              )
                            : data.articles[i].description
                            ? data.articles[i].description
                            : ""
                    }`;
                    html +=
                        "<a href='" +
                        data.articles[i].url +
                        "' target='_blank'>Continue Reading...</a>";
                    html += "</div>";
                    html += "<div class='news-author'>";
                    html += data.articles[i].author
                        ? "Author: " + data.articles[i].author
                        : "";
                    html += "</div>";
                    html += "<div class='news-published'>";
                    html += data.articles[i].publishedAt
                        ? "Published: " +
                          data.articles[i].publishedAt.substring(0, 10)
                        : "";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                }
                $("#row").html(html);
            })
            .catch((error) => {
                $("#row").html(
                    `<h5 style='color: red; text-align:center; font-weight: 1.2rem'>Connection timeout... </h5>`
                );
                console.error(error);
            });
    };
    news();
});
