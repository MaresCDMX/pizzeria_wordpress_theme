const { registerBlockType } = wp.blocks;
const { MediaUpload } = window.wp.blockEditor;
const { IconButton } = window.wp.components;

//Logo para el bloque
import { ReactComponent as Logo } from "../logo.svg";

registerBlockType("lapizzeria/galeria", {
  title: "La Pizzeria Galeria",
  icon: { src: Logo },
  category: "lapizzeria",
  attributes: {
    imagenes: {
      type: "array",
    },
  },
  edit: (props) => {
    //Extraer los valores
    const {
      attributes: { imagenes = [] },
      setAttributes,
    } = props;

    const borrarImagen = (imagenIndex) => {
      setAttributes({
        imagenes: imagenes.filter((_, i) => i !== imagenIndex),
      });
    };

    const onSelectNuevaImagen = (newImage) => {
      const imagen = {
        thumb: newImage.sizes.medium.url,
        full: newImage.sizes.full.url,
        id: newImage.id,
      };
      setAttributes({ imagenes: [...imagenes, imagen] });
    };

    return (
      <div className="galeria-pizzeria">
        <MediaUpload
          onSelect={onSelectNuevaImagen}
          type="image"
          render={({ open }) => (
            <IconButton
              className="lapizzeria-agregar-imagen"
              onClick={open}
              icon="format-image"
              showTooltip="true"
              label="Agregar Imagen"
            />
          )}
        />
        <h2 className="texto-primario">Galería</h2>
        <ul className="galeria-pizzeria-lista">
          {imagenes.map((imagen, index) => (
            <li className="galeria-pizzeria-item" key={index}>
              <div
                className="borrar-imagen"
                onClick={() => borrarImagen(index)}
              >
                <span className="dashicons dashicons-trash"></span>
              </div>
              <img src={imagen.thumb} />
            </li>
          ))}
        </ul>
      </div>
    );
  },
  save: (props) => {
    const {
      attributes: { imagenes = [] },
    } = props;
    if (imagenes.length === 0) {
      return <p>No hay imagenes</p>;
    }
    return (
      <div className="galeria-pizzeria">
        <h2 className="texto-primario">Galería</h2>
        <ul className="galeria-pizzeria-lista">
          {imagenes.map((imagen) => (
            <li className="galeria-pizzeria-item">
              <a href={imagen.full} data-lightbox='galeria'>
                <img src={imagen.thumb} />
              </a>
            </li>
          ))}
        </ul>
      </div>
    );
  },
});
