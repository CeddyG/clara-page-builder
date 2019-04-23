{!! BootForm::text(__('page-text.title_page'), 'page_text['.$iIdView.'][title_page]') !!}
{!! BootForm::text(__('page-text.url_page'), 'page_text['.$iIdView.'][url_page]') !!}
{!! BootForm::textarea(__('page-text.content_page'), 'page_text['.$iIdView.'][content_page]')->addClass('ckeditor') !!}
{!! BootForm::textarea(__('page-text.description_page'), 'page_text['.$iIdView.'][description_page]') !!}
{!! BootForm::textarea(__('page-text.css_page'), 'page_text['.$iIdView.'][css_page]') !!}
{!! BootForm::textarea(__('page-text.js_page'), 'page_text['.$iIdView.'][js_page]') !!}