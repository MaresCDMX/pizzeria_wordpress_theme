const { registerBlockType } = wp.blocks;
const { MediaUpload, InnerBlocks } = window.wp.blockEditor;
const { IconButton } = window.wp.components;

//Logo para el bloque
import { ReactComponent as Logo } from "../logo.svg";

registerBlockType("lapizzeria/contenedor", {
  title: "Pizzeria Contenedor",
  icon: { src: Logo },
  category: "lapizzeria",
  attributes: {
    imageBg: {
      type: "string",
      selector: ".bloque-contenedor",
    },
  },
  edit: (props) => {
    const {
      attributes: { imageBg },
      setAttributes,
    } = props;
    const onSelectImage = (newImage) => {
      setAttributes({
        imageBg: newImage.sizes.full.url,
      });
    };
    return (
      <div
        className="bloque-contenedor"
        style={{
          backgroundImage: `url(${imageBg}`,
        }}
      >
        <div className="contenido-bloque">
          <div className="imagen-fondo">
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
          </div>
          <div className="bloques-internos">
            <InnerBlocks />
          </div>
        </div>
      </div>
    );
  },
  save: (props) => {
    const {
      attributes: { imageBg },
    } = props;
    return (
      <div
        className="bloque-contenedor"
        style={{
          backgroundImage: `url(${imageBg}`,
        }}
      >
        <div className="contenido-bloque">
          <div className="imagen-fondo"></div>
          <div className="bloques-internos">
            <InnerBlocks.Content />
          </div>
        </div>
      </div>
    );
  },
});
