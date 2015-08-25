 // Load the Google Transliterate API
      google.load("elements", "1", {
            packages: "transliteration"
          });

      function onLoad() {
        var options = {
          sourceLanguage: 'en', // or google.elements.transliteration.LanguageCode.ENGLISH,
          destinationLanguage: ['kn'], // or [google.elements.transliteration.LanguageCode.HINDI],
          transliterationEnabled: true
        };
        // Create an instance on TransliterationControl with the required
        // options.
        var control =
            new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textfields with the given ids.
        var elements = ["cd-name", "cd-company"];
        control.makeTransliteratable(elements);

        // Show the transliteration control which can be used to toggle between
        // English and Hindi.
        control.showControl('translControl');
      }
      google.setOnLoadCallback(onLoad);
