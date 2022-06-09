const { registerBlockType } = wp.blocks;
const { MediaUpload, RichText, URLInputButton } = window.wp.editor;
const { IconButton } = window.wp.components;
//Logo para el bloque
import { ReactComponent as Logo } from "../logo.svg";

registerBlockType("lapizzeria/ingedientes", {
  title: "La Pizzeria Ingredientes",
  icon: { src: Logo },
  category: "lapizzeria",
  attributes: {
    imageBg: {
      type: "string",
      selector: ".ingredientes-bloque",
    },
    imageIngredientes: {
      type: "string",
      selector: ".imagen-ingredientes img",
      default: Logo,
    },
    title: {
      type: "string",
      selector: ".texto-ingredientes h1",
    },
    text: {
      type: "string",
      selector: ".texto-ingredientes p",
    },
    urlHero: {
      type: "string",
      attribute: "href",
    },
  },
  supports: {
    align: ["wide", "full"],
  },

  edit: (props) => {
    const {
      attributes: { imageBg, imageIngredientes, title, text, urlHero },
      setAttributes,
    } = props;
    const onSelectImage = (newImage) => {
      setAttributes({
        imageBg: newImage.sizes.full.url,
      });
    };
    const onSelectImageIngredientes = (newImage) => {
      setAttributes({
        imageIngredientes: newImage.sizes.full.url,
      });
    };
    const onChangeTitle = (newTitle) => {
      setAttributes({
        title: newTitle,
      });
    };
    const onChangeText = (newText) => {
      setAttributes({
        text: newText,
      });
    };
    const onChangeUrl = (newUrl) => {
      setAttributes({
        urlHero: newUrl,
      });
    };

    return (
      <div
        className="ingredientes-bloque"
        style={{
          height: `${450}px`,
          backgroundImage: `url(${imageBg}`,
        }}
      >
        <MediaUpload
          onSelect={onSelectImage}
          type="image"
          render={({ open }) => (
            <IconButton
              className="lapizzeria-agregar-imagen"
              onClick={open}
              icon="format-image"
              showTooltip="true"
              label="Seleccionar imagen"
            />
          )}
        />
        <div className="contenido-ingredientes">
          <div className="texto-ingredientes">
            <h1 className="titulo">
              <RichText
                placeholder="Agrega el Título del Hero"
                value={title}
                onChange={onChangeTitle}
              />
            </h1>
            <p className="text">
              <RichText
                placeholder="Agrega el Texto del Hero"
                value={text}
                onChange={onChangeText}
              />
            </p>
            <div>
              <a href={urlHero} className="boton boton-secundario">
                Leer Más
              </a>
              <URLInputButton onChange={onChangeUrl} url={urlHero} />
            </div>
          </div>
          <div className="imagen-ingredientes">
            <img src={imageIngredientes} />
            <MediaUpload
              onSelect={onSelectImageIngredientes}
              type="image"
              render={({ open }) => (
                <IconButton
                  className="lapizzeria-agregar-imagen"
                  onClick={open}
                  icon="format-image"
                  showTooltip="true"
                  label="Seleccionar imagen"
                />
              )}
            />
          </div>
        </div>
      </div>
    );
  },
  save: (props) => {
    const {
      attributes: { imageBg, imageIngredientes, title, text, urlHero },
    } = props;
    return (
      <div
        className="ingredientes-bloque"
        style={{
          height: `${450}px`,
          backgroundImage: `url(${imageBg}`,
        }}
      >
        <div className="contenido-ingredientes">
          <div className="texto-ingredientes">
            <h1 className="titulo">
              <RichText.Content value={title} />
            </h1>
            <p className="text">
              <RichText.Content value={text} />
            </p>
            <div>
              <a href={urlHero} className="boton boton-secundario">
                Leer Más
              </a>
            </div>
          </div>
          <div className="imagen-ingredientes">
            <img src={imageIngredientes} />
          </div>
        </div>
      </div>
    );
  },
});
