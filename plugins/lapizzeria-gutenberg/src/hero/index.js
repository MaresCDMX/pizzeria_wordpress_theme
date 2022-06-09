const { registerBlockType } = wp.blocks;
const {
  MediaUpload,
  RichText,
  URLInputButton,
  BlockControls,
  AlignmentToolbar,
  InspectorControls,
} = window.wp.editor;
const { IconButton, PanelBody, TextControl } = window.wp.components;
//Logo para el bloque
import { ReactComponent as Logo } from "../logo.svg";

registerBlockType("lapizzeria/hero", {
  title: "La Pizzeria Hero",
  icon: { src: Logo },
  category: "lapizzeria",
  attributes: {
    imagenHero: {
      type: "string",
      selector: ".hero-block",
    },
    titulo: {
      type: "string",
      selector: ".titulo h1",
    },
    texto: {
      type: "string",
      selector: ".texto p",
    },
    urlHero: {
      type: "string",
      attribute: "href",
    },
    alineacion: {
      type: "string",
      default: "center",
    },
    alturaHero: {
      type: "number",
      default: "500",
    },
  },
  supports: {
    align: ["wide", "full"],
  },

  edit: (props) => {
    const {
      attributes: {
        imagenHero,
        titulo,
        texto,
        urlHero,
        alineacion,
        alturaHero,
      },
      setAttributes,
    } = props;
    const onSelectImage = (newImage) => {
      setAttributes({
        imagenHero: newImage.sizes.full.url,
      });
    };
    const onChangeTitle = (newTitulo) => {
      setAttributes({
        titulo: newTitulo,
      });
    };

    const onChangeText = (newTexto) => {
      setAttributes({
        texto: newTexto,
      });
    };

    const onChangeUrl = (newUrl) => {
      setAttributes({
        urlHero: newUrl,
      });
    };

    const onChangeAlignment = (newAlineacion) => {
      setAttributes({
        alineacion: newAlineacion,
      });
    };

    const onChangeAlturaHero = (newAltura) => {
      setAttributes({ alturaHero: parseInt(newAltura) });
    };

    return (
      <>
        <InspectorControls>
          <PanelBody title={"Altura Hero"} initalOpen={true}>
            <div className="components-base-control">
              <div className="components-base-control__field">
                <label className="components-base-control__label">
                  Altura en pixeles
                </label>
                <TextControl
                  type="number"
                  min={400}
                  max={700}
                  step={10}
                  onChange={onChangeAlturaHero}
                  value={alturaHero || 500}
                />
              </div>
            </div>
          </PanelBody>
        </InspectorControls>
        <div
          className="hero-block"
          style={{
            backgroundImage: `linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)),url(${imagenHero}`,
            textAlign: alineacion,
            height: `${alturaHero || 500}px`,
          }}
        >
          <BlockControls>
            <AlignmentToolbar value={alineacion} onChange={onChangeAlignment} />
          </BlockControls>
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
          <h1 className="titulo">
            <RichText
              placeholder="Agrega el Titulo del Hero"
              onChange={onChangeTitle}
              value={titulo}
            />
          </h1>
          <p className="texto">
            <RichText
              placeholder="Agrega el Texto del Hero"
              onChange={onChangeText}
              value={texto}
            />
          </p>
          <div>
            <a href={urlHero} className="boton boton-primario">
              Leer Más
            </a>
            <URLInputButton onChange={onChangeUrl} url={urlHero} />
          </div>
        </div>
      </>
    );
  },
  save: (props) => {
    const {
      attributes: {
        imagenHero,
        titulo,
        texto,
        urlHero,
        alineacion,
        alturaHero,
      },
    } = props;
    return (
      <div
        className="hero-block"
        style={{
          textAlign: alineacion,
          height: `${alturaHero || 500}px`,
          backgroundImage: `linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)),url(${imagenHero}`,
        }}
      >
        <h1 className="titulo">
          <RichText.Content value={titulo} />
        </h1>
        <p className="texto">
          <RichText.Content value={texto} />
        </p>
        <div>
          <a href={urlHero} className="boton boton-primario">
            Leer Más
          </a>
        </div>
      </div>
    );
  },
});
