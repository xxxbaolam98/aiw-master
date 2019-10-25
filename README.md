# aiw
news website

    Ví dụ cho một article 
    
    {
      "id": 1,
      "title": "lorem",
      "short_intro": "ipsom",
      "content": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras malesuada quam id turpis feugiat tristique. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac tristique lacus, ut sodales diam. Praesent odio elit, eleifend in maximus sit amet, aliquam et quam.",
      "date_created": "ipsom",
      "author": "John Doe",
      "comments": [
        {
          "id": 1,
          "body": "lorem"
        },
        {
          "id": 2,
          "body": "lorem"
        }
      ],
      "tags": [
        {
          "name": "technology"
        },
        {
          "name": "trend"
        }
      ],
      "category": "lorem"
    }





=======================================================
T sẽ cần mấy api như thế này.
1. GetAllArticles -> id + headlines + date + author 
2. GetArticleById(int id) -> all content of article
3. GetAllArticlesByTag(string tag) -> id + headlines + date + author 
4. PostComment(int articleId, string commentBody)
